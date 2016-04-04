<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Config;
use Mvc5\Plugin\Call;
use Mvc5\Plugin\Filter;
use Mvc5\Plugin\Hydrator;
use Mvc5\Plugin\Invoke;
use Mvc5\Plugin\Plug;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Resolver\Resolver\Model\Hydrate;
use Mvc5\Test\Test\TestCase;

class HydrateTest
    extends TestCase
{
    /**
     *
     */
    public function test_hydrate_does_nothing()
    {
        $resolver = new Resolver;

        $this->assertEquals(new \stdClass, $resolver->hydrate(new Hydrator(null, []), new \stdClass));
    }

    /**
     *
     */
    public function test_hydrate_array_access_set()
    {
        $resolver = new Resolver;

        $plugin = new Hydrator(null, ['#foo' => 'bar']);

        $this->assertEquals(new Config(['foo' => 'bar']), $resolver->hydrate($plugin, new Config));
    }

    /**
     *
     */
    public function test_hydrate_property_access_set()
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
    public function test_hydrate_call_method_on_current_object_with_single_argument()
    {
        $resolver = new Resolver;

        $plugin = new Hydrator(null, ['name' => 'foo']);

        $object = $resolver->hydrate($plugin, new Hydrate);

        $this->assertInstanceOf(Hydrate::class, $object);

        $this->assertEquals('foo', $object->name());
    }

    /**
     *
     */
    public function test_hydrate_call_method_on_current_object_with_multiple_args()
    {
        $resolver = new Resolver;

        $plugin = new Hydrator(null, [['init', 'name' => 'foo', 'id' => 'bar']]);

        $object = $resolver->hydrate($plugin, new Hydrate);

        $this->assertInstanceOf(Hydrate::class, $object);

        $this->assertEquals('foo', $object->name());

        $this->assertEquals('bar', $object->id());
    }

    /**
     * [$service, $method]
     */
    public function test_hydrate_call_service_object_and_pass_current_object_as_named_arg()
    {
        $resolver = new Resolver;

        $initializer = new Hydrate;

        $plugin = new Hydrator(null, [['$object', [new Filter($initializer), 'initialize'], 'foo' => 'foo']]);

        $object = $resolver->hydrate($plugin, new Hydrate);

        $this->assertInstanceOf(Hydrate::class, $object);

        $this->assertTrue($initializer !== $object);

        $this->assertEquals('foo', $object->name());
    }

    /**
     * $this->resolve($method)
     */
    public function test_hydrate_call_function_with_args()
    {
        $resolver = new Resolver;

        $function = function($name) {
            if ('foo' !== $name) {
                throw new \Exception;
            }
        };

        $plugin = new Hydrator(null, [[$function, 'foo']]);

        $object = $resolver->hydrate($plugin, new Hydrate);

        $this->assertInstanceOf(Hydrate::class, $object);
    }

    /**
     * $this->resolve($method)
     */
    public function test_hydrate_call_function_with_args_and_current_object()
    {
        $resolver = new Resolver;

        $resolver->configure('foo', 'bar');

        $function = new Invoke(function(Hydrate $object, $name) {
            $object->name($name);

            return $object;
        });

        $plugin = new Hydrator(null, [['$object', $function, 'name' => new Plug('foo')]]);

        $object = $resolver->hydrate($plugin, new Hydrate);

        $this->assertInstanceOf(Hydrate::class, $object);

        $this->assertEquals('bar', $object->name());
    }

    /**
     *
     */
    public function test_hydrate_resolvable()
    {
        $resolver = new Resolver;

        $called = false;

        $call = new Call(function() use(&$called) {
            $called = true;
        });

        $plugin = new Hydrator(null, [$call]);

        $this->assertInstanceOf(Hydrate::class, $resolver->hydrate($plugin, new Hydrate));

        $this->assertTrue($called);
    }
}
