<?php
namespace App\Api\Github;

use Illuminate\Support\ServiceProvider;
use App\Api\Github\Github;

class GithubProvider extends ServiceProvider
{


    protected $defer = true;
    
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Github::class, function ($app) {
            return new Github(env('GITHUB_USER'));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Github::class];
    }
}