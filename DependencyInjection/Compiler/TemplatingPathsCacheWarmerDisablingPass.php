<?php

namespace FranckRanaivo\Bundle\MultipleInheritBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class TemplatingPathsCacheWarmerDisablingPass disables compiling template paths, for proper getting
 * template paths for inherited templates in inherited bundles.
 *
 * @TODO: modify standard cache warmers to work with bundle inheritance
 *
 * @package FranckRanaivo\Bundle\MultipleInheritBundle\DependencyInjection\Compiler
 */
class TemplatingPathsCacheWarmerDisablingPass implements CompilerPassInterface {

    /**
     * @inheritdoc
     */
    public function process(ContainerBuilder $container)
    {
        foreach (array('twig.cache_warmer', 'templating.cache_warmer.template_paths') as $name) {
            if ($container->hasDefinition($name)) {
                $definition = $container->getDefinition($name);
                $definition->setClass('FranckRanaivo\Bundle\MultipleInheritBundle\CacheWarmer\DummyCacheWarmer');
            }
        }
    }
}