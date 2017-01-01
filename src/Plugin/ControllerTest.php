<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Controller;
use Mvc5\Test\Test\TestCase;

class ControllerTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $controller = new Controller('foo', ['bar'], ['baz']);

        $this->assertEquals('foo', $controller->name());
        $this->assertEquals('controller', $controller->parent());
        $this->assertTrue($controller->merge());
        $this->assertEquals(['bar'], $controller->args());
        $this->assertEquals(['baz'], $controller->calls());
    }
}
