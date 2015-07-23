<?php

namespace Flysap\ModuleManager;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Yaml\Yaml;

class ThemeServiceProvider extends ServiceProvider {

    /**
     * On boot's application load package requirements .
     */
    public function boot() {
        $this->loadRoutes()
            ->loadConfiguration()
            ->loadViews();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {

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