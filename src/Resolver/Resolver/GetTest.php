<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class GetTest
    extends TestCase
{
    /**
     *
     */
    public function test_get_shared()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['get']);

        $mock->expects($this->once())
             ->method('shared')
             ->willReturn('bar');

        $this->assertEquals('bar', $mock->get('foo'));
    }

    /**
     *
     */
    public function test_get_plugin()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['get']);

        $mock->expects($this->once())
             ->method('shared')
             ->willReturn(null);

        $mock->expects($this->any())
             ->method('plugin')
             ->willReturn('bar');

        $this->assertEquals('bar', $mock->get('foo'));
    }
}
