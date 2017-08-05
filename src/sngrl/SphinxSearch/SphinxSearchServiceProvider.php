<?php 
namespace sngrl\SphinxSearch;

use Illuminate\Support\ServiceProvider;

class SphinxSearchServiceProvider extends ServiceProvider
{
    public function register()
    {
        $configPath = __DIR__.'/../../../config/sphinxsearch.php';
        $this->mergeConfigFrom($configPath, 'sphinxsearch');

        $this->app->singleton(SphinxSearch::class, function ($app) {
            return new SphinxSearch;
        });
    }


    public function boot()
    {
        $this->publishes([
            ## Original
            #__DIR__.'../../../../config/sphinxsearch.php' => config_path('sphinxsearch.php'),

            ## https://github.com/sngrl/sphinxsearch/issues/3
            __DIR__.'/../../../config/sphinxsearch.php' => config_path('sphinxsearch.php'),
        ]);
    }

}
