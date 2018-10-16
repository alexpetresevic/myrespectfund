<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use WePay;
use App\User;
use App\WepayAccount;
use Illuminate\Support\Facades\Config;
use App\Exceptions\WepayServiceException;
use WePayPermissionException;

class WepayService
{
    const AVAILABLE_ENV = ['staging', 'production'];
    
    private $environment;
    private $clientId;
    private $accountId;
    private $clientSecret;
    private $accessToken;
    
    /**
     * WepayService constructor.
     * @throws WepayServiceException
     */
    public function __construct()
    {
        $this->checkConfigFile();
        $this->setConfig();
        
        if ($this->environment === 'staging') {
            WePay::useStaging($this->clientId, $this->clientSecret);
        }elseif ($this->environment === 'production') {
            WePay::useProduction($this->clientId, $this->clientSecret);
        }
    }
    
    /**
     * @param User $user
     *
     * @throws \Exception
     * @throws \WePayException
     */
    public function register(User $user)
    {
        try {
            $merchant = $this->registerUser($user);
            $this->createAccount($merchant, $user);
            $this->sendConfirmation($merchant);
        } catch (\Exception $e) {
            // Handle exception
        }

    }
    
    /**
     * @param User $user
     *
     * @return \StdClass
     * @throws \Exception
     * @throws \WePayException
     */
    private function registerUser(User $user)
    {
        $wepay = new WePay($this->accessToken);

        return $wepay->request('user/register', [
            'client_id'           => $this->clientId,
            'client_secret'       => $this->clientSecret,
            'email'               => $user->email,
            'scope'               => 'manage_accounts,collect_payments,view_user,preapprove_payments,send_money',
            'first_name'          => $user->first_name,
            'last_name'           => $user->last_name,
            'original_ip'         => request()->ip(),
            'original_device'     => request()->userAgent(),
            'tos_acceptance_time' => time(),
        ]);
    }
    
    /**
     * @param $merchant
     *
     * @throws \Exception
     * @throws \WePayException
     */
    private function createAccount($merchant, $user)
    {
        $wepay = new WePay($merchant->access_token);
        
        $account = $wepay->request('account/create', [
            'name'        => $user->first_name . ' ' . $user->last_name,
            'description' => 'My respects fundraiser campaign.',
        ]);

        $wepayAccount = new WepayAccount();

        $wepayAccount->user_id = $user->id;
        $wepayAccount->access_token = $merchant->access_token;
        $wepayAccount->account_id = $account->account_id;
        $wepayAccount->save();
    }
    
    /**
     * @param $merchant
     *
     * @throws \Exception
     * @throws \WePayException
     */
    private function sendConfirmation($merchant)
    {
        $wepay = new WePay($merchant->access_token);
        
        $wepay->request('user/send_confirmation', []);
    }
    
    private function setConfig()
    {
        $this->clientId = Config::get('wepay.client_id');
        $this->accountId = Config::get('wepay.account_id');
        $this->clientSecret = Config::get('wepay.client_secret');
        $this->accessToken = Config::get('wepay.access_token');
        $this->environment = Config::get('wepay.environment');
    }
    
    public function sendRequest($accessToken, $donations, $accountId)
    {
        if (is_null($accessToken)) {
            $accessToken = $this->accessToken;
        }

        $wepay = new WePay($accessToken);
      
        if (is_null($accountId)) {
            $accountId = $this->accountId;
        }

        $responses = [];
        foreach ($donations as $donation) {

            try{
                $response = $wepay->request('checkout/create', array(
                    'account_id'        => $accountId,
                    'amount'            => $donation->amount,
                    'currency'          => 'USD',
                    'short_description' => 'MyRespects donation',
                    'type'              => 'donation',
                    'payment_method'    => array(
                        'type'        => 'credit_card',
                        'credit_card' => array(
                            'id' => $donation->credit_card_id
                        )
                    )
                ));
              
                array_push($responses, $response);
                $donation->charged = 1;
                $donation->update();
            }catch (WePayPermissionException $e){
                return $e->getMessage();
            }

        }
      
        return [$responses];
    }
    
    public function preApprovalCreate($accessToken, $donation, $accountId)
    {
        if (is_null($accessToken)) {
            $accessToken = $this->accessToken;
        }
        
        $wepay = new WePay($accessToken);
        
        if (is_null($accountId)) {
            $accountId = $this->accountId;
        }

            try {
                $response = $wepay->request('credit_card/authorize', array(
                    'client_id' => env('WEPAY_CLIENT_ID'),
                    'client_secret' => env('WEPAY_CLIENT_SECRET'),
                    'credit_card_id' => $donation->credit_card_id
                ));

            } catch (\Exception $e){
                return $e->getMessage();
            }
    
        return $response;    
    }
    
    /**
     * @throws WepayServiceException
     */
    private function checkConfigFile()
    {
        if ( ! config('wepay.environment')) {
            throw new WepayServiceException('WePay Environment is not set. Check your configuration');
        }
        
        if ( ! in_array(config('wepay.environment'), self::AVAILABLE_ENV)) {
            throw new WepayServiceException('Invalid WePay Environment. Possible values are \'staging\' or \'production\'');
        }
        
        if ( ! config('wepay.client_id')) {
            throw new WepayServiceException('WePay Client ID is missing. Check your configuration');
        }
        
        if ( ! config('wepay.client_secret')) {
            throw new WepayServiceException('WePay Client Secret is missing. Check your configuration');
        }
        
        if ( ! config('wepay.access_token')) {
            throw new WepayServiceException('WePay Access Token is missing. Check your configuration');
        }
        
        if ( ! config('wepay.access_token')) {
            throw new WepayServiceException('WePay Access Token is missing. Check your configuration');
        }
    }
}
