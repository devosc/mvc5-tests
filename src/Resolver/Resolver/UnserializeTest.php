<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\App;
use Mvc5\Session\Config as Session;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class UnserializeTest
    extends TestCase
{
    /**
     *
     */
    function test_serialize()
    {
        $session = new Session;

        @$session->start();

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

        $session['resolver'] = $resolver;

        $session->close();

        @$session->start();

        $this->assertEquals([], $session['resolver']->container());

        $session->destroy(false);
    }
}
