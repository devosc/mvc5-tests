<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\App;
use Mvc5\Plugin\Copy;
use Mvc5\Test\Test\TestCase;

class CopyTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $object = new \stdClass;

        $copy = (new App)->plugin(new Copy($object));

        $this->assertEquals($object, $copy);
        $this->assertFalse($object === $copy);
    }
}
