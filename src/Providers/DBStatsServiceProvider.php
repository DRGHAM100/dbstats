<?php
namespace drgham\DBStats\Providers;

use Illuminate\Support\ServiceProvider;

class DBStatsServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register your package services or dependencies here
    }

    public function boot()
    {
        // Load routes and views
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'dbstats');
        
        // Publish configuration file
        $this->publishes([
            __DIR__ . '/../../config/dbstats.php' => config_path('dbstats.php'),
        ]);
    }
}
