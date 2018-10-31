<?php

namespace MykitchensCeresTheme\Containers;

use Plenty\Plugin\Templates\Twig;

class MykitchensCeresThemeContainer
{
    public function call(Twig $twig):string
    {
        return $twig->render('MykitchensCeresTheme::VueScripts');
    }
}
