<?php

namespace Modules\Tenants\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Tenants\Observers\RepairRequestObserver;
use Modules\Tenants\Entities\RepairRequest;

class TenantsServiceProvider extends ServiceProvider
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

         RepairRequest::observe(RepairRequestObserver::class);
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
            __DIR__.'/../Config/config.php' => config_path('tenants.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'tenants'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/tenants');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/tenants';
        }, \Config::get('view.paths')), [$sourcePath]), 'tenants');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/tenants');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'tenants');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'tenants');
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
