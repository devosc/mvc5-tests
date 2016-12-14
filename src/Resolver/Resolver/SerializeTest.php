<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\App;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class SerializeTest
    extends TestCase
{
    /**
     *
     */
    function test_serialize()
    {
        $resolver = new Resolver;

        $config = ['foo' => 'bar'];
        $resolver->config($config);

        $container = ['baz' => function() {}];
        $resolver->container($container);

        $events = ['bar' => 'baz'];
        $resolver->config($events);

        $provider = new App;
        $resolver->setProvider($provider);

        $resolver->setScope(true);

        $resolver->setStrict(true);

        $serialized = serialize($resolver);

        $this->assertTrue(is_string($serialized));

        $this->assertEquals([], unserialize($serialized)->container());
    }
}
