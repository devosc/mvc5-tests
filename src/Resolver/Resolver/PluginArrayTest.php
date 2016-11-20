<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class PluginArrayTest
    extends TestCase
{
    /**
     *
     */
    function test_plugin_array_previous_name_equal_to_service_name()
    {
        $resolver = new Resolver;

        $resolver->configure('Mvc5\Layout', ['Mvc5\Layout', 'template' => 'foo']);

        $layout = $resolver->pluginArray('Mvc5\Layout', ['template' => 'foo'], null, 'Mvc5\Layout');

        $this->assertEquals('foo', $layout->template());
    }
    /**
     *
     */
    function test_plugin_array_service_name_not_the_same()
    {
        $resolver = new Resolver;

        $resolver->configure('layout', ['Mvc5\Layout', 'template' => 'foo']);

        $layout = $resolver->pluginArray('layout');

        $this->assertEquals('foo', $layout->template());
    }
}
