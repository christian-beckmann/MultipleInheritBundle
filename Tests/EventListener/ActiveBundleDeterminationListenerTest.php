<?php

namespace FranckRanaivo\Bundle\MultipleInheritBundle\Tests\EventListener;

use FranckRanaivo\Bundle\MultipleInheritBundle\EventListener\ActiveBundleDeterminationListener;
use FranckRanaivo\Bundle\MultipleInheritBundle\Routing\RoutingAdditionsInterface;
use FranckRanaivo\Bundle\MultipleInheritBundle\Tests\Fixtures\Child1Bundle\Controller\ChildBundle1TestController;
use FranckRanaivo\Bundle\MultipleInheritBundle\Tests\Fixtures\Child2Bundle\Controller\ChildBundle2TestController;
use FranckRanaivo\Bundle\MultipleInheritBundle\Tests\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class ActiveBundleDeterminationListenerTest extends TestCase
{

    public function testActiveBundleInjectionFromRouteController()
    {
        $kernel  = $this->buildKernel();
        $request = Request::create('/');

        $listener = new ActiveBundleDeterminationListener($kernel);
        $listener->onControllerEvent($this->getEvent($request, array(new ChildBundle1TestController(), 'someAction')));

        $this->assertEquals($this->child1Bundle->getName(), $kernel->getActiveBundle()->getName());
    }

    public function testActiveBundleInjectionFromRequestArgument()
    {
        $kernel  = $this->buildKernel();
        $request = Request::create('/');
        $request->attributes->set(RoutingAdditionsInterface::ACTIVE_BUNDLE_ATTRIBUTE, $this->child1Bundle->getName());

        $listener = new ActiveBundleDeterminationListener($kernel);
        // Controller does not used here to determine bundle, so active bundle need to be first, not second child bundle
        $listener->onControllerEvent($this->getEvent($request, array(new ChildBundle2TestController(), 'someAction')));

        $this->assertEquals($this->child1Bundle->getName(), $kernel->getActiveBundle()->getName());
    }

    protected function getEvent(Request $request, $controller)
    {
        return new FilterControllerEvent(
            $this->getMock('Symfony\Component\HttpKernel\HttpKernelInterface'),
            $controller,
            $request,
            HttpKernelInterface::MASTER_REQUEST
        );
    }

}