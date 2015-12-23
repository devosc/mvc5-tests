<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class RepeatTest
    extends TestCase
{
    /**
     *
     */
    public function test_repeat_no_config()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['repeat', 'repeatTest']);

        $mock->expects($this->once())
            ->method('invoke')
            ->willReturn('bar');

        $this->assertEquals('bar', $mock->repeatTest('foo', 'baz'));
    }

    /**
     *
     */
    public function test_repeat_config()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['repeat', 'repeatTest']);

        $mock->expects($this->any())
             ->method('invoke')
             ->willreturn('baz');

        $this->assertEquals('baz', $mock->repeatTest('foo', 'baz', ['foobar']));
    }
}
