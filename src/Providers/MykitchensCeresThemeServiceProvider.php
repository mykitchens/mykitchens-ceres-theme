<?php

namespace MykitchensCeresTheme\Providers;

use IO\Services\ContentCaching\Services\Container;
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Plugin\Templates\Twig;
use IO\Helper\TemplateContainer;
use IO\Extensions\Functions\Partial;
use Plenty\Plugin\ConfigRepository;

/**
 * Class mykitchensCeresThemeServiceProvider
 * @package mykitchensCeresTheme\Providers
 */
class MykitchensCeresThemeServiceProvider extends ServiceProvider
{
    const PRIORITY = 0;

    public function register()
    {

    }

    public function boot(Twig $twig, Dispatcher $dispatcher)
    {
        // Override partials

        $dispatcher->listen('IO.init.templates', function (Partial $partial)
        {
            $partial->set('footer', 'MykitchensCeresTheme::PageDesign.Partials.Footer');
        }, self::PRIORITY);
        return false;
    }
}
