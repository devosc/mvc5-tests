<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\Value;
use Mvc5\Test\Test\TestCase;

final class ValueTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $value = new Value('foo');

        $this->assertEquals('foo', $value->config());
    }

    /**
     *
     */
    function test_plugin()
    {
        $this->assertEquals('foo', (new App)->plugin(new Value('foo')));
    }
}
