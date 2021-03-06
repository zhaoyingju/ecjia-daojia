<?php 

namespace Royalcms\Component\Gettext;

use Royalcms\Component\Support\ServiceProvider;

class GettextServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->royalcms->singleton('gettext', function ($royalcms) {
            $locale = new Locale();
            $textdomain = new TextdomainManager($locale);
            return new Gettext($royalcms, $textdomain);
        });

        $this->royalcms->booting(function () {
            $loader = \Royalcms\Component\Foundation\AliasLoader::getInstance();
            $loader->alias('RC_Gettext', 'Royalcms\Component\Gettext\Facades\Gettext');
            $loader->alias('RC_Locale', 'Royalcms\Component\Gettext\Facades\Gettext');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('gettext');
    }
}
