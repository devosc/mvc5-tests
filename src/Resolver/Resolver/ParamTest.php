<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ParamTest
    extends TestCase
{
    /**
     *
     */
    public function test_param()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['param']);

        $mock->expects($this->once())
            ->method('config')
            ->willReturn(['foo' => ['bar' => 'baz']]);

        $this->assertEquals('baz', $mock->param('foo.bar'));
    }
}
