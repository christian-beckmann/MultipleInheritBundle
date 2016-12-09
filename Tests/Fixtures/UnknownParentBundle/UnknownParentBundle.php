<?php

namespace Init\Bundle\MultipleInheritBundle\Tests\Fixtures\UnknownParentBundle;


use Init\Bundle\MultipleInheritBundle\Tests\Fixtures\BaseBundle;

class UnknownParentBundle extends BaseBundle
{

    public function getParent()
    {
        return 'CatchMeIfYouCanBundle';
    }

}