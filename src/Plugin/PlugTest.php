<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

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
        $plug = new Plug('foo');

        $this->assertEquals('foo', $plug->name());
    }

    /**
     *
     */
    function test_plugin()
    {
        $app = new App([
            'services' => [
                'foo' => 'bar'
            ]
        ]);

        $this->assertEquals('bar', $app->plugin(new Plug('foo')));
    }
}
