<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Payment\MedicalPaymentDataInterface;
use App\Services\Payment\SodaMedicalPaymentData;

class MedicalPaymentDataServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MedicalPaymentDataInterface::class, function ($app) {
            return new SodaMedicalPaymentData();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [MedicalPaymentDataInterface::class];
    }
}
