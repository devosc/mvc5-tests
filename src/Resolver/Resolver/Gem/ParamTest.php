<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\App;
use Mvc5\Plugin\Param;
use Mvc5\Test\Test\TestCase;

class ParamTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $app = new App;
        $app->config(['foo' => 'bar']);

        $this->assertEquals('bar', $app->plugin(new Param('foo')));
    }
}
