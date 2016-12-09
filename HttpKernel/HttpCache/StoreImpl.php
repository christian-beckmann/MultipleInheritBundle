<?php

namespace Init\Bundle\MultipleInheritanceBundle\HttpKernel\HttpCache;


use Init\Bundle\MultipleInheritanceBundle\HttpKernel\BundleInheritanceKernel;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class StoreImpl injects active bundle in cache key
 *
 * @package Init\Bundle\MultipleInheritanceBundle\HttpKernel\HttpCache
 */
class StoreImpl extends Store
{

    protected $keyCache;

    /**
     * @var \Init\Bundle\MultipleInheritanceBundle\HttpKernel\BundleInheritanceKernel
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