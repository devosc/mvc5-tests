<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Invokable;
use Mvc5\Test\Test\TestCase;

class InvokableTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $invokable = new Invokable('foo', ['bar']);

        $this->assertEquals('foo', $invokable->config());
        $this->assertEquals(['bar'], $invokable->args());
    }
}
