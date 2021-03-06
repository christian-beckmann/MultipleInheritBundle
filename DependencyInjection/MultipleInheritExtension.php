<?php

namespace FranckRanaivo\Bundle\MultipleInheritBundle\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class MultipleInheritExtension extends Extension
{

    /**
     * @inheritdoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = array();
        // http://symfony.com/doc/2.0/cookbook/bundles/extension.html#parsing-the-configs-array
        foreach ($configs as $subConfig) {
            $config = array_merge($config, $subConfig);
        }

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $loader->load('services.xml');
        
        foreach (array('router.options.generator_class', 'router.options.generator_base_class') as $generatorClasses) {
            $container->setParameter($generatorClasses, 'FranckRanaivo\Bundle\MultipleInheritBundle\Routing\Generator');
        }

        $this->addClassesToCompile(
            array(
                'FranckRanaivo\\Bundle\\MultipleInheritBundle\\EventListener\\ActiveBundleDeterminationListener',
                'FranckRanaivo\\Bundle\\MultipleInheritBundle\\DependencyInjection\\Loader\\YamlFileLoader',
            )
        );
    }
}
