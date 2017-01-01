<?php
/**
 *
 */

namespace Mvc5\Test\Request\Exception;

use Mvc5\Http\Error\ServerError;
use Mvc5\Request\Exception;
use Mvc5\Request\Config as Request;
use Mvc5\Test\Test\TestCase;

class ExceptionTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $exception = new Exception('exception', 'exception\controller');

        $request = $exception(new Request, new \Exception);

        $this->assertInstanceOf(Request::class, $request);
        $this->assertEquals('exception', $request['name']);
        $this->assertEquals('exception\controller', $request['controller']);
        $this->assertInstanceOf(ServerError::class, $request['error']);
        $this->assertInstanceOf(\Exception::class, $request['exception']);
    }
}
