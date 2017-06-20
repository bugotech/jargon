<?php namespace Bugotech\Jargon;

use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Support\ServiceProvider;

class JargonServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerLoader();

        $this->app->singleton('jargon', function ($app) {
            $loader = $app['jargon.loader'];

            // When registering the translator component, we'll need to set the default
            // locale as well as the fallback locale. So, we'll grab the application
            // configuration so we can easily get both of these values from there.
            $jargon = $app['config']['app.jargon'];

            $trans = new Translator($loader, $jargon);

            $trans->setFallback($app['config']['app.fallback_jargon']);

            return $trans;
        });
    }

    /**
     * Register the translation line loader.
     *
     * @return void
     */
    protected function registerLoader()
    {
        $this->app->singleton('jargon.loader', function ($app) {
            return new FileLoader($app['files'], $app['path.jargon']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['jargon', 'jargon.loader'];
    }
}
