<?php

namespace FranckRanaivo\Bundle\MultipleInheritBundle\HttpKernel\HttpCache;


use FranckRanaivo\Bundle\MultipleInheritBundle\HttpKernel\BundleInheritanceKernel;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class StoreImpl injects active bundle in cache key
 *
 * @package FranckRanaivo\Bundle\MultipleInheritBundle\HttpKernel\HttpCache
 */
class StoreImpl extends Store
{

    protected $keyCache;

    /**
     * @var \FranckRanaivo\Bundle\MultipleInheritBundle\HttpKernel\BundleInheritanceKernel
     */
    private $kernel;

    function __construct(BundleInheritanceKernel $kernel, $rootPath)
    {
        parent::__construct($rootPath);

        $this->keyCache = new \SplObjectStorage();

        $this->kernel = $kernel;
    }

    /**
     * @inheritdoc
     */
    protected function getCacheKey(Request $request)
    {
        if (isset($this->keyCache[$request])) {
            return $this->keyCache[$request];
        }


        return $this->keyCache[$request] = 'md' . sha1($this->doGetCacheKey($request));
    }

    /**
     * @param Request $request
     * @return string
     */
    protected function doGetCacheKey(Request $request)
    {
        $bundleKey = '';
        if (null !== ($activeBundle = $this->kernel->getActiveBundle())) {
            $bundleKey = $activeBundle->getName();
        }

        return $request->getUri() . $bundleKey;
    }

}