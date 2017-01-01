<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

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
}
