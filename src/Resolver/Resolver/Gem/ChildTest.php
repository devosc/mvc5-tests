<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Plugin\Child;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Test\TestCase;

class ChildTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $app = new App;
        $app->configure('bar', new Plugin(Config::class));

        $this->assertInstanceOf(Config::class, $app->plugin(new Child('foo', 'bar')));
    }
}
