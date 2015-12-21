<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Build;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class FirstTest
    extends TestCase
{
    /**
     *
     */
    public function test_first_with_no_others()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['first', 'firstTest']);

        $mock->expects($this->once())
             ->method('callback')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->firstTest('foo', []));
    }

    /**
     *
     */
    public function test_first_with_others()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['first', 'firstTest']);

        $mock->expects($this->once())
             ->method('create')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->firstTest('foo', ['bar']));
    }
}
