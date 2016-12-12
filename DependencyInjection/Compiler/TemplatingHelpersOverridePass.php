<?php

namespace FranckRanaivo\Bundle\MultipleInheritBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Reference;

class TemplatingHelpersOverridePass implements CompilerPassInterface {

    /**
     * @inheritdoc
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefFranckRanaivoion('templating.helper.actions')) {
            $defFranckRanaivoion = $container->getDefFranckRanaivoion('templating.helper.actions');

            $defFranckRanaivoion
                ->setClass('FranckRanaivo\Bundle\MultipleInheritBundle\Templating\Helper\ActionsHelper')
                ->addArgument(new Reference('controller_name_converter', ContainerInterface::IGNORE_ON_INVALID_REFERENCE, false));
        }
    }
}