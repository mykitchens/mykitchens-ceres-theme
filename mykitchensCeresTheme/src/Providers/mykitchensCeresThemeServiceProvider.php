<?php

namespace mykitchensCeresTheme\Providers;

use IO\Services\ContentCaching\Services\Container;
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Events\Dispatcher;
use IO\Helper\TemplateContainer;
use IO\Helper\TemplateContainer;
use IO\Extensions\Functions\Partial;
use Plenty\Plugin\ConfigRepository;

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

        $enabledOverrides = explode(", ", $config->get("MykitchensCeresTheme.templates.override"));
        // Override partials

        $dispatcher->listen('IO.tpl.home', function (Partial $partial) use ($enabledOverrides)
        {
            $partial->set('footer', 'Ceres::PageDesign.Partials.Footer');

            if (in_array("footer", $enabledOverrides) || in_array("all", $enabledOverrides))
            {
                $partial->set('footer', 'MykitchensCeresTheme::PageDesign.Partials.Footer');
            }

            return false;
        }, self::PRIORITY);
    }
}
