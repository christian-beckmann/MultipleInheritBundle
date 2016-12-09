<?php

namespace Init\Bundle\MultipleInheritBundle\Tests\Fixtures\UnknownParentBundle\DependencyInjection;


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class UnknownParentExtension extends Extension
{

    public function load(array $config, ContainerBuilder $container)
    {
    }
}