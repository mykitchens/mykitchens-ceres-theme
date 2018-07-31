<?php

namespace mykitchensCeresTheme\Containers;

use Plenty\Plugin\Templates\Twig;

class mykitchensCeresThemeContainer
{
    public function call(Twig $twig):string
    {
        return $twig->render('mykitchensCeresTheme::Theme');
    }
}