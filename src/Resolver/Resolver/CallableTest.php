<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Resolver\Resolver\Model\CallableObject;
use Mvc5\Test\Test\TestCase;

class CallableTest
    extends TestCase
{
    /**
     *
     */
    function test_callable_string()
    {
        $resolver = new Resolver;

        $this->assertInstanceOf(\Closure::class, $resolver->callableMethod('foo'));
    }

    /**
     *
     */
    function test_callable_array_string()
    {
        $resolver = new Resolver;

        $config = [CallableObject::class, 'test'];

        $this->assertEquals($config, $resolver->callableMethod($config));
    }

    /**
     *
     */
    function test_callable_array_object()
    {
        $resolver = new Resolver;

        $config = [new CallableObject, 'test'];

        $this->assertEquals($config, $resolver->callableMethod($config));
    }

    /**
     *
     */
    function test_callable_closure()
    {
        $resolver = new Resolver;

        $this->assertEquals(function(){}, $resolver->callableMethod(function(){}));
    }

    /**
     *
     */
    function test_callable_object()
    {
        $resolver = new Resolver;

        $obj = new CallableObject;

        $this->assertEquals($obj, $resolver->callableMethod($obj));
    }
}
