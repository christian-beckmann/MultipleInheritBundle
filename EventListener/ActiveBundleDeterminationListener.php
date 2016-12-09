<?php


namespace Init\Bundle\MultipleInheritBundle\EventListener;


use Init\Bundle\MultipleInheritBundle\HttpKernel\BundleInheritanceKernel;
use Init\Bundle\MultipleInheritBundle\Routing\RoutingAdditionsInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class ActiveBundleDeterminationListener implements EventSubscriberInterface
{

    /**
     * @var \Init\Bundle\MultipleInheritBundle\HttpKernel\BundleInheritanceKernel
     */
    private $kernel;
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger = null;

    public function __construct(BundleInheritanceKernel $kernel, LoggerInterface $logger = null)
    {
        $this->kernel = $kernel;
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => 'onControllerEvent'
        );
    }

    public function onControllerEvent(FilterControllerEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST != $event->getRequestType()
            || null !== $this->kernel->getActiveBundle()
        ) {
            return;
        }

        if ($event->getRequest()->attributes->has(RoutingAdditionsInterface::ACTIVE_BUNDLE_ATTRIBUTE)) {
            $bundle = $this->kernel->getBundle(
                $event->getRequest()->attributes->get(RoutingAdditionsInterface::ACTIVE_BUNDLE_ATTRIBUTE)
            );
        } else {
            $controller = $event->getController();
            $controllerClass = get_class($controller[0]);

            $bundle = $this->getBundleForClass($controllerClass);
        }

        if (null !== $this->logger && null !== $bundle) {
            $this->logger->debug(sprintf('Injecting active bundle "%s"', $bundle->getName()));
        }

        $this->kernel->setActiveBundle($bundle);
    }

    /**
     * @param $class
     *
     * @return BundleInterface|null
     */
    private function getBundleForClass($class)
    {
        foreach ($this->kernel->getBundles() as $bundle) {
            if (0 === strpos($class, $bundle->getNamespace())) {
                return $bundle;
            }
        }

        return null;
    }

}
