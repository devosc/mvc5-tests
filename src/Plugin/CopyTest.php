<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\Copy;
use Mvc5\Test\Test\TestCase;

final class CopyTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $copy = new Copy('foo');

        $this->assertEquals('foo', $copy->config());
    }

    /**
     *
     */
    function test_plugin()
    {
        $object = new \stdClass;

        $copy = (new App)->plugin(new Copy($object));

        $this->assertEquals($object, $copy);
        $this->assertFalse($object === $copy);
    }
}
