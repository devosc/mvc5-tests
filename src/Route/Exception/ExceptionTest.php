<?php

namespace Mvc5\Test\Route\Exception;

use Mvc5\Route\Exception\Exception;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;

class ExceptionTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $route = $this->getCleanMock(Route::class);

        $exception = new Exception($route, new \Exception);

        $this->assertInstanceOf(Exception::class, $exception);
    }

    /**
     *
     */
    public function test_args()
    {
        $mock = $this->getCleanMock(ArgsException::class, ['args']);

        $this->assertTrue(is_array($mock->args()));
    }
}
