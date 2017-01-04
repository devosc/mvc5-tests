<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\App;
use Mvc5\Plugin\Plug;
use Mvc5\Test\Test\TestCase;

class PlugTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $app = new App;
        $app->configure('foo', 'bar');

        $this->assertEquals('bar', $app->plugin(new Plug('foo')));
    }
}
