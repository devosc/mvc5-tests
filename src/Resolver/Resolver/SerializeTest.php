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
        $resolver->events($events);

        $provider = new App;
        $resolver->setProvider($provider);

        $resolver->setScope(true);
        $resolver->setStrict(true);

        $serialized = serialize($resolver);
        $this->assertTrue(is_string($serialized));

        $resolver = unserialize($serialized);
        $this->assertEquals($config, $resolver->config());
        $this->assertEmpty($resolver->container());
        $this->assertEquals($events, $resolver->events());
        $this->assertEquals($provider, $resolver->provider());
        $this->assertTrue($resolver->scope());
        $this->assertTrue($resolver->strict());
    }
}
