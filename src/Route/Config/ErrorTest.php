<?php
/**
 *
 */

namespace Mvc5\Test\Route\Config;

use Mvc5\Route\Config\Error;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ErrorTest
    extends TestCase
{
    /**
     *
     */
    public function test_route()
    {
        /** @var Error|Mock $mock */

        $mock = $this->getCleanMockForTrait(Error::class, ['route']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->route());
    }
}
