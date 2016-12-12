<?php

namespace FranckRanaivo\Bundle\MultipleInheritBundle\Tests\HttpKernel;


use FranckRanaivo\Bundle\MultipleInheritBundle\HttpKernel\HttpCache\StoreImpl;
use FranckRanaivo\Bundle\MultipleInheritBundle\Tests\TestCase;
use Symfony\Component\HttpFoundation\Request;

class CacheStoreTest extends TestCase
{

    public function testThatForDifferentActiveBundlesCacheKeysAreDifferent()
    {
        $request = Request::create('/');

        $getCacheKeyMethod = $this->getMethod(
            'FranckRanaivo\Bundle\MultipleInheritBundle\HttpKernel\HttpCache\StoreImpl',
            'getCacheKey'
        );

        $kernel1 = $this->buildKernel();
        $kernel2 = $this->buildKernel();
        $kernel1->setActiveBundle(null);
        $kernel2->setActiveBundle($this->parentBundle);

        $store1 = new StoreImpl($kernel1, sys_get_temp_dir());
        $store2 = new StoreImpl($kernel2, sys_get_temp_dir());

        $this->assertNotEquals(
            $getCacheKeyMethod->invokeArgs($store1, array($request)),
            $getCacheKeyMethod->invokeArgs($store2, array($request))
        );
    }

    protected function getMethod($class, $name)
    {
        $class = new \ReflectionClass($class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }

}