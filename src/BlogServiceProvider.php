<?php

namespace Sanjok\Blog;

use Illuminate\Support\ServiceProvider;
use Sanjok\Blog\Console\Commands\CreateSuperUser;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'sanjok');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'sanjok');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');


        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        // to publish your package configuration file to the default application “config” directory.
        //When users of your package execute “vendor:publish” command,
        //then our package config file will be copied to the specific publish location.
        $this->publishes([
            __DIR__.'config/blog.php' => config_path('blog.php'),
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/blog.php', 'blog');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'Blog');

        // Register the service the package provides.
        $this->app->singleton('blog', function ($app) {
            return new Blog;
        });

        //all the repositories
        $this->registerRepositories();

        //helpers for blog
        $this->registerHelpers();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['blog'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/blog.php' => config_path('blog.php'),
        ], 'blog.config');

        // Publishing the views.
        $this->publishes([
            __DIR__.'resources/views' => base_path('resources/views/vendor/sanjok'),
        ], 'blog.views');

        // Publishing assets.
        $this->publishes([
            __DIR__.'/public' => public_path('vendor/sanjok'),
        ], 'blog.views');

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/sanjok'),
        ], 'blog.views');*/

        // Registering package commands.
         $this->commands([
             CreateSuperUser::class
         ]);

    }

    /**
     * Register repositories
     *
     * @return void
     */
    public function registerRepositories()
    {
        $repos = config('app.repositories');
        if(is_array($repos))
        foreach ( $repos as $key => $value) {
            return $this->app->bind($key, $value);
        }
    }

    /**
     * Register helpers
     *
     * @return void
     */
    private function registerHelpers()
    {
        foreach (glob(realpath(__DIR__.'/../Helpers').'/*.php') as $filename) {
            require_once($filename);
        }
    }


}
