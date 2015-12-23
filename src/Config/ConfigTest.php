<?php
/**
 *
 */

namespace Mvc5\Test\Config;

use Mvc5\Config\Config;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ConfigTest
    extends TestCase
{
    /**
     *
     */
    public function test_get()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMockForTrait(Config::class, ['get']);

        $mock->method('offsetGet')
            ->will($this->returnValue('bar'));

        $this->assertEquals('bar', $mock->offsetGet('foo'));
    }

    /**
     *
     */
    public function test_has()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMockForTrait(Config::class, ['has']);

        $mock->method('offsetExists')
             ->will($this->returnValue(true));

        $this->assertTrue($mock->offsetExists('foo'));
    }

    /**
     *
     */
    public function test_remove()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMockForTrait(Config::class, ['remove']);

        $mock->expects($this->once())
            ->method('offsetUnset');

        $mock->remove('foo');
    }

    /**
     *
     */
    public function test_set()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMockForTrait(Config::class, ['set']);

        $mock->expects($this->once())
            ->method('offsetSet')
            ->willReturn('bar');

        $this->assertEquals('bar', $mock->offsetSet('foo', 'bar'));
    }
}
