<?php

namespace Init\Bundle\MultipleInheritBundle\CacheWarmer;


use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface;

/**
 * Class DummyCacheWarmer used to replace some symfony cache warmers.
 *
 * @package Init\Bundle\MultipleInheritBundle\CacheWarmer
 */
class DummyCacheWarmer implements CacheWarmerInterface {

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
}