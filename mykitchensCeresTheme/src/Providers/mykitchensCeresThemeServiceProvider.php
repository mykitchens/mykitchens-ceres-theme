<?php

namespace mykitchensCeresTheme\Providers;

use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Events\Dispatcher;
use IO\Helper\TemplateContainer;

/**
 * Class mykitchensCeresThemeServiceProvider
 * @package mykitchensCeresTheme\Providers
 */
class mykitchensCeresThemeServiceProvider extends ServiceProvider
{
    const PRIORITY = 0;

    public function register()
    {
        
    }

    public function boot(Dispatcher $dispatcher)
    {
       	// Override template
        $dispatcher->listen('IO.tpl.home', function (TemplateContainer $container) {
            $container->setTemplate('mykitchensCeresTheme::Homepage.Homepage');
            return false;
        }, self::PRIORITY);
    }
}