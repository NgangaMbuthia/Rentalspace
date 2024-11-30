<?php

namespace Modules\Backend\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Backend\Entities\Property;
use Modules\Backend\Observers\PropertyObserver;
use Modules\Backend\Entities\Tenant;
use Modules\Backend\Observers\TenantObserver;
 use Modules\Backend\Observers\PropertyTransactionOBserver;
use Modules\Backend\Entities\PropertyTransaction;
use Modules\Backend\Entities\UtitlityBill;
use Modules\Backend\Observers\UtilityBillObserver;
use Modules\Backend\Entities\Agent;
use Modules\Backend\Observers\ProviderObserver;


class BackendServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {


        Property::observe(PropertyObserver::class);
        Agent::observe(ProviderObserver::class);
        Tenant::observe(TenantObserver::class);
        PropertyTransaction::observe(PropertyTransactionOBserver::class);
        UtitlityBill::observe(UtilityBillObserver::class);

        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('backend.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'backend'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/backend');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/backend';
        }, \Config::get('view.paths')), [$sourcePath]), 'backend');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/backend');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'backend');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'backend');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
