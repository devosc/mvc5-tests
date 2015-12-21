<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Build;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class CallbackTest
    extends TestCase
{
    /**
     *
     */
    public function test_callback_no_class_exists()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['callback', 'callbackTest']);

        $this->assertEquals('bar', $mock->callbackTest('foo', [], function() { return 'bar'; }));
    }

    /**
     *
     */
    public function test_callback_class_exists()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['callback', 'callbackTest']);

        $mock->expects($this->once())
             ->method('make')
             ->willReturn('bar');

        $this->assertEquals('bar', $mock->callbackTest(self::class, [], function() { return 'bar'; }));
    }
}
