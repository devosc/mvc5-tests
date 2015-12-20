<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ResolveTest
    extends TestCase
{
    /**
     *
     */
    public function test_resolve()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolve', 'resolveTest']);

        $mock->expects($this->once())
             ->method('resolvable')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolveTest(false));
    }
}
