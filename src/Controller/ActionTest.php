<?php
/**
 *
 */

namespace Mvc5\Test\Controller;

use Mvc5\Response\Error;
use Mvc5\Response\Response;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ActionTest
    extends TestCase
{
    /**
     *
     */
    public function test_action()
    {
        /** @var Action|Mock $mock */

        $mock = $this->getCleanAbstractMock(Action::class, ['action', 'actionTest']);

        $mock->expects($this->once())
             ->method('call')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->actionTest(function() {}));
    }

    /**
     *
     */
    public function test_error()
    {
        /** @var Action|Mock $mock */

        $mock = $this->getCleanAbstractMock(Action::class, ['error', 'errorTest']);

        $mock->expects($this->once())
             ->method('call')
             ->willReturn('foo');

        /** @var Error|Mock $error */

        $error = $this->getCleanMock(Error::class);

        /** @var Response|Mock $response */

        $response = $this->getCleanMock(Response::class);

        $this->assertEquals('foo', $mock->errorTest($error, $response));
    }

    /**
     *
     */
    public function test_exception()
    {
        /** @var Action|Mock $mock */

        $mock = $this->getCleanAbstractMock(Action::class, ['exception', 'exceptionTest']);

        $mock->expects($this->once())
            ->method('call')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->exceptionTest(new \Exception, null));
    }
}
