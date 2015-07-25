<?php

namespace Flysap\ThemeManager;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;

class ThemeServiceProvider extends ServiceProvider {

    /**
     * On boot's application load package requirements .
     */
    public function boot() {
        $this->loadRoutes()
            ->loadConfiguration()
            ->loadViews();

        view()->share('total_themes', count(
            app('theme-caching')->toArray()
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
            return new ThemeManager(
                new Finder()
            );
        });

        /** Register caching theme . */
        $this->app->singleton('theme-caching', function() {
            return new ThemeCache(
                new Finder()
            );
        });

        /** Register theme manager service layer . */
        $this->app->singleton('theme-service', function($app) {
            return new ThemeService(
                $app['theme-caching'], $app['theme-manager']
            );
        });
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
        $array = Yaml::parse(file_get_contents(
            __DIR__ . '/../configuration/general.yaml'
        ));

        $config = $this->app['config']->get('theme-manager', []);

        $this->app['config']->set('theme-manager', array_merge($array, $config));

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