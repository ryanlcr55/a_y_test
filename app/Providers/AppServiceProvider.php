<?php

namespace App\Providers;

use App\Modules\ManualOperation\Services\ManualOperationService;
use App\Modules\ManualOperation\Services\ManualOperationServiceExposable;
use App\Services\LoadCurrencyFromConfigService;
use App\Services\LoadCurrencyInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LoadCurrencyInterface::class, LoadCurrencyFromConfigService::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
