<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\Provide;
use Mvc5\Test\Test\TestCase;

class ProvideTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $provide = new Provide('foo', ['bar']);

        $this->assertEquals('foo', $provide->config());
        $this->assertEquals(['bar'], $provide->args());
    }

    /**
     *
     */
    function test_no_provider()
    {
        $app = new App;

        $this->setExpectedException(\RuntimeException::class, 'Unresolvable plugin: bar');

        $app->plugin(new Provide('bar'));
    }

    /**
     *
     */
    function test_provide()
    {
        $app = new App(null, function($foo) { return $foo; });

        $this->assertEquals('bar', $app->plugin(new Provide('bar')));
    }
}
