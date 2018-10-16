<?php

namespace App\Observers;

use App\User;
use App\Services\WepayService;
use Illuminate\Support\Facades\Config;

class UserObserver
{
    public function created(User $user)
    {
        if ( ! $user->is('affiliate')) {
            $this->registerWePayAccount($user);
        }
    }
    
    public function deleting(User $user)
    {
    
    }
    
    private function registerWePayAccount($user)
    {
        if (Config::get('wepay.enabled')) {
            $wepayService = new WepayService();
            $wepayService->register($user);
        }
    }
}
