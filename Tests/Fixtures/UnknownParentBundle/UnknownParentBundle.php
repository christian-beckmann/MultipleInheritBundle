<?php

namespace Init\Bundle\MultipleInheritanceBundle\Tests\Fixtures\UnknownParentBundle;


use Init\Bundle\MultipleInheritanceBundle\Tests\Fixtures\BaseBundle;

class UnknownParentBundle extends BaseBundle
{

    public function getParent()
    {
        return 'CatchMeIfYouCanBundle';
    }

}