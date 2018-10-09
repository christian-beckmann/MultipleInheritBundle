<?php

namespace FranckRanaivo\Bundle\MultipleInheritBundle\CacheWarmer;


use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface;
use Symfony\Component\DependencyInjection\ServiceSubscriberInterface;
use Twig\Environment;

/**
 * Class DummyCacheWarmer used to replace some symfony cache warmers.
 *
 * @package FranckRanaivo\Bundle\MultipleInheritBundle\CacheWarmer
 */
class DummyCacheWarmer implements CacheWarmerInterface, ServiceSubscriberInterface {

    /**
     * @inheritdoc
     */
    public function isOptional()
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function warmUp($cacheDir)
    {
        // Do nothing
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedServices()
    {
        return array(
            'twig' => '?'.Environment::class,
        );
    }

}