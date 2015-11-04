<?php

namespace Mvc5\Test\Config;

use Mvc5\Config\ArrayAccess;
use Mvc5\Test\Test\TestCase;

class ArrayAccessTest
    extends TestCase
{
    /**
     *
     */
    public function test_offsetExists()
    {
        $mock = $this->getCleanMockForTrait(ArrayAccess::class, ['offsetExists']);

        $mock->method('has')
             ->will($this->returnValue(true));

        $this->assertTrue($mock->offsetExists('foo'));
    }

    /**
     *
     */
    public function test_offsetGet()
    {
        $mock = $this->getCleanMockForTrait(ArrayAccess::class, ['offsetGet']);

        $mock->method('get')
             ->will($this->returnValue('bar'));

        $this->assertEquals('bar', $mock->offsetGet('foo'));
    }

    /**
     *
     */
    public function test_offsetSet()
    {
        $mock = $this->getCleanMockForTrait(ArrayAccess::class, ['offsetSet']);

        $mock->expects($this->once())
             ->method('set')
             ->willReturn('bar');

        $this->assertEquals('bar', $mock->offsetSet('foo', 'bar'));
    }

    /**
     *
     */
    public function test_offsetUnset()
    {
        $mock = $this->getCleanMockForTrait(ArrayAccess::class, ['offsetUnset']);

        $this->assertEquals(null, $mock->offsetUnset('foo'));
    }
}
