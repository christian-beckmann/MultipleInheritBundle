<?php

namespace FranckRanaivo\Bundle\MultipleInheritBundle\Tests\Fixtures\UnknownParentBundle;


use FranckRanaivo\Bundle\MultipleInheritBundle\Tests\Fixtures\BaseBundle;

class UnknownParentBundle extends BaseBundle
{

    public function getParent()
    {
        return 'CatchMeIfYouCanBundle';
    }

}