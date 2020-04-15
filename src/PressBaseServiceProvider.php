<?php

namespace Midstackdev\Press;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Midstackdev\Press\Console\ProcessCommand;
use Midstackdev\Press\Facades\Press;

class PressBaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }

        $this->registerResources();
    }

    public function register()
    {
        $this->commands([
            ProcessCommand::class,
        ]);
    }

    private function registerResources()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'press');

        $this->registerFacades();
        $this->registerRoutes();
        $this->registerFields();
    }

    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/../config/press.php' => config_path('press.php'),
        ], 'press-config');

        $this->publishes([
            __DIR__.'/Console/stubs/PressServiceProvider.stub' => app_path('Providers/PressServiceProvider.php'),
        ], 'press-provider');
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function() {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => Press::path(),
            'namespace' => 'Midstackdev\Press\Http\Controllers',
        ];
    }

    protected function registerFacades()
    {
        $this->app->singleton('Press', function ($app) {
            return new \Midstackdev\Press\Press();
        });
    }

    protected function registerFields()
    {
        Press::fields([
            Fields\Body::class,
            Fields\Date::class,
            Fields\Description::class,
            Fields\Extra::class,
            Fields\Title::class,
        ]);
    }







}