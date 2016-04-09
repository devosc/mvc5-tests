<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Arg;
use Mvc5\Config;
use Mvc5\Event;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class InvokableTest
    extends TestCase
{
    /**
     *
     */
    public function test_invokable_string()
    {
        $resolver = new Resolver;

        $this->assertEquals('foo', $resolver->invokable('@foo'));
    }

    /**
     *
     */
    public function test_invokable_provider()
    {
        $resolver = new Resolver;

        $resolver->setProvider(function() { return 'bar'; });

        $this->assertEquals('bar', $resolver->invokable('foo'));
    }

    /**
     *
     */
    public function test_invokable_closure_with_provider()
    {
        $plugin = new Config;

        $provider = new Resolver;

        $provider->configure('bar', $plugin);

        $resolver = new Resolver;

        $resolver->setProvider($provider);

        $resolver->configure('foo', function($bar) { return $bar; });

        $this->assertEquals($plugin, $resolver->invokable('foo'));
    }

    /**
     *
     */
    public function test_invokable_closure()
    {
        $resolver = new Resolver;

        $plugin = new Config;

        $resolver->configure('foo', function($bar) { return $bar; });

        $resolver->configure('bar', $plugin);

        $this->assertEquals($plugin, $resolver->invokable('foo'));
    }

    /**
     *
     */
    public function test_invokable_event()
    {
        $resolver = new Resolver;

        $resolver->events([
            'foo' => [
                function() {
                    return 'bar';
                }
            ]
        ]);

        $resolver->services([Arg::EVENT_MODEL => Event::class]);

        $invokable = $resolver->invokable('foo');

        $this->assertInstanceOf(\Closure::class, $invokable);

        $this->assertEquals('bar', $invokable());
    }
}
