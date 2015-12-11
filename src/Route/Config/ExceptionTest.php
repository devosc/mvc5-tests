<?php
/**
 *
 */

namespace Mvc5\Test\Route\Config;

use Mvc5\Route\Config\Exception;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ExceptionTest
    extends TestCase
{
    /**
     *
     */
    public function test_exception()
    {
        /** @var Exception|Mock $mock */

        $mock = $this->getCleanMockForTrait(Exception::class, ['exception']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->exception());
    }
}
