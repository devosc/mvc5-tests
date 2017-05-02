<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

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
        $param = new Param('foo');

        $this->assertEquals('foo', $param->name());
    }

    /**
     *
     */
    function test_plugin()
    {
        $app = new App(['foo' => ['bar' => 'baz']]);

        $this->assertEquals('baz', $app->plugin(new Param('foo.bar')));
    }
}
