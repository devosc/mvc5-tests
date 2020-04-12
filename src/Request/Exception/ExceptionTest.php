<?php
/**
 *
 */

namespace Mvc5\Test\Request\Exception;

use Mvc5\Http\Error\ServerError;
use Mvc5\Request\Exception;
use Mvc5\Request\HttpRequest;
use Mvc5\Test\Test\TestCase;

final class ExceptionTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $exception = new Exception('exception', 'exception\controller');

        $request = $exception(new HttpRequest, new \Exception);

        $this->assertInstanceOf(HttpRequest::class, $request);
        $this->assertEquals('exception', $request['name']);
        $this->assertEquals('exception\controller', $request['controller']);
        $this->assertInstanceOf(ServerError::class, $request['error']);
        $this->assertInstanceOf(\Exception::class, $request['exception']);
    }
}
