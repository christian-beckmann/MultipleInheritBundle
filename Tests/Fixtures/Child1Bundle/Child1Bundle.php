<?php

namespace Init\Bundle\MultipleInheritBundle\Tests\Fixtures\Child1Bundle;


use Init\Bundle\MultipleInheritBundle\Tests\Fixtures\BaseBundle;

class Child1Bundle extends BaseBundle
{
    public function getParent()
    {
        return 'ParentBundle';
    }

}