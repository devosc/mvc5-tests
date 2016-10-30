<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\App;
use Mvc5\Test\Test\TestCase;

class RenderTest
    extends TestCase
{
    /**
     *
     */
    function test_render()
    {
        $config = ['services' => ['render' => function() { return function($template) { return $template; }; }]];

        $plugin = new RenderPlugin(new App($config));

        $this->assertEquals('home', $plugin('home'));
    }
}
