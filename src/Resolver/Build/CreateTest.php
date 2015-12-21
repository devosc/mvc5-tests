<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Build;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class CreateTest
    extends TestCase
{
    /**
     *
     */
    public function test_create()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['create', 'createTest']);

        $mock->expects($this->once())
             ->method('configured');

        $mock->expects($this->once())
             ->method('unique')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->createTest('foo'));
    }
}
