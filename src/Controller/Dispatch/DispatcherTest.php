<?php

namespace Mvc5\Test\Controller\Dispatch;

use Mvc5\Controller\Dispatch\Dispatcher;
use Mvc5\Test\Test\TestCase;

class DispatcherTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        $mock = $this->getCleanMock(Dispatcher::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('action')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke(function() {}));
    }
}
