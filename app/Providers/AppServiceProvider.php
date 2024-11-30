<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Observers\TenantPaymentObserver;
use App\Observers\InvoiceObserver;
use App\Observers\ProviderModuleObserver;
use Modules\Backend\Entities\TenantPayment;
use Modules\Backend\Entities\Invoice;
use App\ProviderModule;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        TenantPayment::observe(TenantPaymentObserver::class);
        Invoice::observe(InvoiceObserver::class);
        ProviderModule::observe(ProviderModuleObserver::class);


        Validator::extend('phone', function($attribute, $value, $parameters, $validator) {

            if (strpos($value, '+') !== false) {
                if(strlen($value)==16)
                {
                    $value = substr($value, 1);
                    if (is_numeric($value)) 
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    return false;
                }
            }
            else
            {
                echo "Telephone Number Must Start With Country Code...eg +254";
                return false;


                
            }

        });
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
