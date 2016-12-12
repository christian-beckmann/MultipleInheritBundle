<?php


namespace FranckRanaivo\Bundle\MultipleInheritBundle;


use FranckRanaivo\Bundle\MultipleInheritBundle\DependencyInjection\Compiler\TemplatingHelpersOverridePass;
use FranckRanaivo\Bundle\MultipleInheritBundle\DependencyInjection\Compiler\TemplatingPathsCacheWarmerDisablingPass;
use FranckRanaivo\Bundle\MultipleInheritBundle\HttpKernel\BundleInheritanceKernel;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\KernelInterface;

class MultipleInheritBundle extends Bundle
{


    function __construct(KernelInterface $kernel)
    {
        if (!$kernel instanceof BundleInheritanceKernel) {
            throw new \InvalidArgumentException('Your kernel must be inherited from FranckRanaivo\Bundle\MultipleInheritBundle\HttpKernel\BundleInheritanceKernel');
        }
    }

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new TemplatingPathsCacheWarmerDisablingPass());
        $container->addCompilerPass(new TemplatingHelpersOverridePass());
    }


}
