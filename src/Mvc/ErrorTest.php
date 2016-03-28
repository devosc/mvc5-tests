<?php
/**
 *
 */

namespace Mvc5\Test\Mvc;

use Mvc5\Mvc\Error;
use Mvc5\Response\Error as ResponseError;
use Mvc5\Response\Response;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ErrorTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        /** @var Error|Mock $mock */

        $mock = $this->getCleanMock(Error::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('error')
             ->willReturn('foo');

        $error = $this->getCleanMock(ResponseError::class);

        $response = $this->getCleanMock(Response::class);

        $this->assertEquals('foo', $mock->__invoke($response, $error));
    }

    /**
     *
     */
    public function test__invoke_no_error()
    {
        /** @var Error|Mock $mock */

        $mock = $this->getCleanMock(Error::class, ['__invoke']);

        $response = $this->getCleanMock(Response::class);

        $this->assertEquals('foo', $mock->__invoke($response, 'foo'));
    }
}
