<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\Copy;
use Mvc5\Test\Resolver\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class CopyTest
    extends TestCase
{
    /**
     *
     */
    public function test_gem_copy()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $object = new \stdClass;

        $copy = $mock->gemTest(new Copy($object));

        $this->assertEquals($object, $copy);

        $this->assertFalse($object === $copy);
    }
}
