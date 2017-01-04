<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

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
        $app = new App;
        $app->configure('bar', function() { return function() { return 'baz'; }; });
        $app->configure('factory', new Plugin('bar'));

        $this->assertEquals('baz', $app->plugin(new Factory('foo')));
    }
}
