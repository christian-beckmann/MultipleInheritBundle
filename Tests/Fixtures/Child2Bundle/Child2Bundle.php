<?php

namespace Init\Bundle\MultipleInheritBundle\Tests\Fixtures\Child2Bundle;


use Init\Bundle\MultipleInheritBundle\Routing\RoutingAdditionsInterface;
use Init\Bundle\MultipleInheritBundle\Tests\Fixtures\BaseBundle;

class Child2Bundle extends BaseBundle implements RoutingAdditionsInterface
{
    public function getParent()
    {
        return 'ParentBundle';
    }

    /**
     * @return string Unique routing prefix
     */
    public function getRoutingPrefix()
    {
        return 'child';
    }

    /**
     * @return array
     */
    public function getDefaults()
    {
        return array();
    }

    /**
     * @return array
     */
    public function getRequirements()
    {
        return array();
    }

    /**
     * @return string empty string by default
     */
    public function getHost()
    {
        return 'test.example.com';
    }

    /**
     * @return array
     */
    public function getResourcesToOverride()
    {
        return array(
            '@ParentBundle/Resources/config/routing.php',
        );
    }
}