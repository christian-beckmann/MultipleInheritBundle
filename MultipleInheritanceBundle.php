<?php


namespace Init\Bundle\MultipleInheritanceBundle;


use Init\Bundle\MultipleInheritanceBundle\DependencyInjection\Compiler\TemplatingHelpersOverridePass;
use Init\Bundle\MultipleInheritanceBundle\DependencyInjection\Compiler\TemplatingPathsCacheWarmerDisablingPass;
use Init\Bundle\MultipleInheritanceBundle\HttpKernel\BundleInheritanceKernel;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\KernelInterface;

class MultipleInheritanceBundle extends Bundle
{


    function __construct(KernelInterface $kernel)
    {
        if (!$kernel instanceof BundleInheritanceKernel) {
            throw new \InvalidArgumentException('Your kernel must be inherited from Init\Bundle\MultipleInheritanceBundle\HttpKernel\BundleInheritanceKernel');
        }
    }

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new TemplatingPathsCacheWarmerDisablingPass());
        $container->addCompilerPass(new TemplatingHelpersOverridePass());
    }


}
