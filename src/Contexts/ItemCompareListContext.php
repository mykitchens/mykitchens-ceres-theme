<?php

namespace MykitchensCeresTheme\Contexts;

use IO\Helper\ContextInterface;
use Ceres\Contexts\GlobalContext;

class ItemCompareListContext extends GlobalContext implements ContextInterface
{
    public $compareList;

    public function init($params)
    {
        parent::init($params);

        $this->compareList = $params['compareList'];
    }
}
