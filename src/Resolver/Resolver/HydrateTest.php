<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Config;
use Mvc5\Plugin\Hydrator;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Resolver\Resolver\Model\AutowireNoConstructor;
use Mvc5\Test\Resolver\Resolver\Model\Hydrate;
use Mvc5\Test\Test\TestCase;

class HydrateTest
    extends TestCase
{
    /**
     *
     */
    public function test_hydrate()
    {
        $resolver = new Resolver;

        $this->assertEquals(new \stdClass, $resolver->hydrate(new Hydrator(null, []), new \stdClass));
    }

    /**
     *
     */
    public function test_hydrate_array_access()
    {
        $resolver = new Resolver;

        $plugin = new Hydrator(null, ['#foo' => 'bar']);

        $this->assertEquals(new Config(['foo' => 'bar']), $resolver->hydrate($plugin, new Config));
    }

    /**
     *
     */
    public function test_hydrate_property_access()
    {
        $resolver = new Resolver;

        $plugin = new Hydrator(null, ['$foo' => 'bar']);

        $config = new Config;

        $config->foo = 'bar';

        $this->assertEquals($config, $resolver->hydrate($plugin, new Config));
    }

    /**
     *
     */
    public function test_hydrate_call_method_with_single_argument()
    {
        $resolver = new Resolver;

        $plugin = new Hydrator(null, ['remove' => 'foo']);

        $this->assertEquals(new Config, $resolver->hydrate($plugin, new Config(['foo' => 'bar'])));
    }

    /**
     *
     */
    public function test_hydrate_array_string_method()
    {
        $resolver = new Resolver;

        $plugin = new Hydrator(null, [['$bar', '__invoke', 'foo' => 'foo']]);

        $this->assertInstanceOf(Hydrate::class, $resolver->hydrate($plugin, new Hydrate));
    }

    /**
     *
     */
    public function test_hydrate_array_array_object()
    {
        $resolver = new Resolver;

        $object = new AutowireNoConstructor;

        $plugin = new Hydrator(null, [['$bar', [$object, '__invoke'], 'foo' => 'foo']]);

        $this->assertInstanceOf(AutowireNoConstructor::class, $resolver->hydrate($plugin, $object));
    }

    /**
     *
     */
    public function test_hydrate_array_service()
    {
        $resolver = new Resolver;

        $object = new Hydrator(null, []);

        $plugin = new Hydrator(null, [[function() {}, ['bar']]]);

        $this->assertInstanceOf(Hydrator::class, $resolver->hydrate($plugin, $object));
    }

    /**
     *
     */
    public function test_hydrate_resolvable()
    {
        $resolver = new Resolver;

        $plugin = new Hydrator(null, [function() {}]);

        $object = new Hydrator(null, []);

        $this->assertInstanceOf(Hydrator::class, $resolver->hydrate($plugin, $object));
    }
}
