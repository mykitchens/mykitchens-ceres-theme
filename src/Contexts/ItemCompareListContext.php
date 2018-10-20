<?php

namespace Ceres\Contexts;

use IO\Helper\ContextInterface;

class ItemCompareListContext extends GlobalContext implements ContextInterface
{
    public $compareList;

    public function init($params)
    {
        parent::init($params);

        $this->compareList = $params['compareList'];
    }
}
