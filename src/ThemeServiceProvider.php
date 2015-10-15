<?php

namespace Flysap\ThemeManager;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\Finder;
use Flysap\Support;

class ThemeServiceProvider extends ServiceProvider {

    /**
     * On boot's application load package requirements .
     */
    public function boot() {
        $this->loadRoutes()
            ->loadConfiguration()
            ->loadViews();

        $this->registerMenu();

        /** On bootstrap set active theme . */
        app('theme-service')
            ->activate(config('theme-manager.default_theme'));

        view()->share('total_themes', count(
            app('theme-repository')->toArray()
        ));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {

        /** Theme uploader . */
        $this->app->singleton('theme-manager', function() {
            return new Uploader(
                new Finder
            );
        });

        /** Register caching theme . */
        $this->app->singleton('theme-repository', function() {
            return new Repository(
                new Finder
            );
        });

        /** Register theme manager service layer . */
        $this->app->singleton('theme-service', function($app) {
            return new ThemeService(
                $app['theme-repository'], $app['theme-manager']
            );
        });
    }

    /**
     * Register menu .
     *
     */
    protected function registerMenu() {
        $menuManager = app('menu-manager');

        $menuManager->addNamespace(realpath(__DIR__ . '/../'), true);
    }

    /**
     * Load routes .
     *
     * @return $this
     */
    protected function loadRoutes() {
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/../routes.php';
        }

        return $this;
    }

    /**
     * Load configuration .
     *
     * @return $this
     */
    protected function loadConfiguration() {
        Support\set_config_from_yaml(
            __DIR__ . '/../configuration/general.yaml' , 'theme-manager'
        );

        return $this;
    }

    /**
     * Load views .
     */
    protected function loadViews() {
        $this->loadViewsFrom(__DIR__.'/../views', 'theme-manager');

        return $this;
    }
}