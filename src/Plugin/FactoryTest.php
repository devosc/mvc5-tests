<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\Factory;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Test\TestCase;

class FactoryTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $factory = new Factory('foo');

        $this->assertEquals('foo', $factory->name());
        $this->assertEquals('factory', $factory->parent());
    }

    /**
     *
     */
    function test_plugin()
    {
        $app = new App;
        $app->configure('bar', function() { return function() { return 'baz'; }; });
        $app->configure('factory', new Plugin('bar'));

        $factory = new Factory('foo');

        $this->assertEquals('baz', $app->plugin($factory));
    }
}
