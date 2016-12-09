<?php

namespace Init\Bundle\MultipleInheritBundle\Tests\Templating;


use Init\Bundle\MultipleInheritBundle\Templating\Helper\ActionsHelper;
use Init\Bundle\MultipleInheritBundle\Tests\TestCase;
use Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser;
use Symfony\Component\HttpKernel\Fragment\FragmentHandler;

class ActionsHelperTest extends TestCase
{

    public function testInheritedControllerNotChanged()
    {
        $kernel = $this->buildKernel();
        $kernel->setActiveBundle(null);

        $actionsHelper = $this->initActionsHelper($kernel);

        $this->assertEquals(
            'Init\Bundle\MultipleInheritBundle\Tests\Fixtures\ParentBundle\Controller\AwesomeController::indexAction',
            $actionsHelper->controller('ParentBundle:Awesome:index')->controller
        );
    }

    public function testInheritedControllerChangedToInheritedBundle()
    {
        $kernel = $this->buildKernel();
        $kernel->setActiveBundle($this->child1Bundle);

        $actionsHelper = $this->initActionsHelper($kernel);

        $this->assertEquals(
            'Init\Bundle\MultipleInheritBundle\Tests\Fixtures\Child1Bundle\Controller\AwesomeController::indexAction',
            $actionsHelper->controller('ParentBundle:Awesome:index')->controller
        );
    }

    protected function initActionsHelper($kernel)
    {
        $controllerNameParser = new ControllerNameParser($kernel);
        $fragmentHandler      = new FragmentHandler(array(), true);
        $actionsHelper        = new ActionsHelper($fragmentHandler, $controllerNameParser);

        return $actionsHelper;
    }

}