<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class CreateTest
    extends TestCase
{
    /**
     *
     */
    public function test_create_plugin()
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

    /**
     *
     */
    public function test_create_callback()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['create', 'createTest']);

        $mock->expects($this->once())
            ->method('configured');

        $mock->expects($this->once())
            ->method('unique')
            ->willReturn('bar');

        $this->assertEquals('bar', $mock->createTest('foo', [], function() { return 'foo'; }));
    }

    /**
     *
     */
    public function test_create_make()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['create', 'createTest']);

        $mock->expects($this->once())
            ->method('configured');

        $mock->expects($this->once())
            ->method('unique');

        $mock->expects($this->once())
             ->method('callback')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->createTest(Resolver::class));
    }
}
