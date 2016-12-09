<?php


namespace Init\Bundle\MultipleInheritBundle;


use Init\Bundle\MultipleInheritBundle\DependencyInjection\Compiler\TemplatingHelpersOverridePass;
use Init\Bundle\MultipleInheritBundle\DependencyInjection\Compiler\TemplatingPathsCacheWarmerDisablingPass;
use Init\Bundle\MultipleInheritBundle\HttpKernel\BundleInheritanceKernel;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\KernelInterface;

class MultipleInheritBundle extends Bundle
{


    function __construct(KernelInterface $kernel)
    {
        if (!$kernel instanceof BundleInheritanceKernel) {
            throw new \InvalidArgumentException('Your kernel must be inherited from Init\Bundle\MultipleInheritBundle\HttpKernel\BundleInheritanceKernel');
        }
    }

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new TemplatingPathsCacheWarmerDisablingPass());
        $container->addCompilerPass(new TemplatingHelpersOverridePass());
    }


}
