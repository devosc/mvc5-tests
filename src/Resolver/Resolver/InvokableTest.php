<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class InvokableTest
    extends TestCase
{
    /**
     *
     */
    public function test_invokable_string()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['invokable', 'invokableTest']);

        $mock->expects($this->once())
             ->method('listener')
             ->willReturn('time');

        $mock->expects($this->once())
             ->method('plugin');

        $this->assertEquals('time', $mock->invokableTest('foo'));
    }

    /**
     *
     */
    public function test_invokable_not_string()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['invokable', 'invokableTest']);

        $mock->expects($this->once())
             ->method('listener')
             ->willReturn('time');

        $mock->expects($this->once())
             ->method('args');

        $this->assertEquals('time', $mock->invokableTest(null));
    }
}
