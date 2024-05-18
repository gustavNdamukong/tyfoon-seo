<?php

namespace Gustocoder\TyfoonSeo;

use Illuminate\Support\ServiceProvider;

class TyfoonSeoServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services. 
     */
    public function boot(): void
    {
        $namespace = "tyfoon-seo";
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views/', $namespace);

        //load migrations
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ]);

        /*$this->publishes([
            __DIR__.'/../config/tyfoon-seo.php' => config_path('tyfoon-seo.php'),
        ]);*/

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/tyfoon-seo'),
        ], 'public');

        /*$this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/tyfoon-seo'),
        ]);*/
    }
}
