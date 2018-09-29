<?php

namespace MykitchensCeresTheme\Providers;

use IO\Services\ContentCaching\Services\Container;
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Plugin\Templates\Twig;
use IO\Helper\TemplateContainer;
use IO\Extensions\Functions\Partial;
use Plenty\Plugin\ConfigRepository;
use IO\Helper\ComponentContainer;
use IO\Services\ItemSearch\Helper\ResultFieldTemplate;

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

    public function boot(Twig $twig, Dispatcher $dispatcher, ConfigRepository $config)
    {
        $enabledOverrides = explode(", ", $config->get("MykitchensCeresTheme.templates.override"));

        // Override partials
        $dispatcher->listen('IO.init.templates', function (Partial $partial) use ($enabledOverrides)
        {

            $partial->set('footer', 'Ceres::PageDesign.Partials.Footer');

            if (in_array("footer", $enabledOverrides) || in_array("all", $enabledOverrides))
            {
                $partial->set('footer', 'MykitchensCeresTheme::PageDesign.Partials.Footer');
            }
            return false;
        }, self::PRIORITY);

        // Override template for content categories
        $dispatcher->listen('IO.tpl.category.content', function (TemplateContainer $container) use ($enabledOverrides)
        {
            $container->setTemplate('Ceres::Category.Content.CategoryContent');

            if (in_array("category_content", $enabledOverrides) || in_array("all", $enabledOverrides))
            {
                $container->setTemplate('MykitchensCeresTheme::Category.Content.CategoryContent');
            }
            return false;
        }, self::PRIORITY);

        // Override single item Wrapper
        $dispatcher->listen('IO.tpl.item', function (TemplateContainer $container) use ($enabledOverrides)
        {
            $container->setTemplate('Ceres::Item.SingleItemWrapper');

            if (in_array("single_item_wrapper", $enabledOverrides) || in_array("all", $enabledOverrides))
            {
                $container->setTemplate('MykitchensCeresTheme::Item.SingleItemWrapper');

            }
            return false;
        }, self::PRIORITY);

        // Override single item page
        $dispatcher->listen('IO.Component.Import', function(ComponentContainer $container)
        {
            $container->setTemplate('Ceres::Item.Components.SingleItem');

            if (in_array("single_item", $enabledOverrides) || in_array("all", $enabledOverrides))
            {
                if( $container->getOriginComponentTemplate() == 'Ceres::Item.Components.SingleItem')
                {
                    $container->setNewComponentTemplate('MykitchensCeresTheme::Item.Components.SingleItem');
                }
            }
            return false;
        }, self::PRIORITY);

        $dispatcher->listen( 'IO.ResultFields.SingleItem', function(ResultFieldTemplate $templateContainer)
        {
            $templateContainer->setTemplates([
                ResultFieldTemplate::TEMPLATE_SINGLE_ITEM   => 'MykitchensCeresTheme::ResultFields.SingleItem'
            ]);
        }, 0);
    }
}
