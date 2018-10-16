<?php

namespace App\Providers;

use App\CampagnUpdate;
use App\Observers\CampaignUpdateObserver;
use App\Organization;
use App\Services\Settings;
use App\User;
use App\FuneralHome;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $settings = Settings::getInstance();
        View::share('settings', $settings);
        view()->composer('campaign.dashboard.*', function ($view)
        {
            $user = auth()->user();
            if (!is_null($user) && $user->campaign->funeralHome){
                $funeralHome = $user->campaign->funeralHome;
                $view->with('funeralHome', $funeralHome);
            }
        });
        
        view()->composer('layouts.app', function ($view){
            $funeralHomes = FuneralHome::all();
            $view->with('funeralHomes', $funeralHomes);

            $settings = Settings::getInstance();
            $view->with('settings', $settings);
        });

        view()->composer('_organisations', function ($view) {
            $organisations = Organization::inRandomOrder()->get();
            $view->with('organisations', $organisations);
        });

        User::observe(UserObserver::class);
        CampagnUpdate::observe(CampaignUpdateObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
