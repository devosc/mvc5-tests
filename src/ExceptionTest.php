<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\Exception;
use Mvc5\Test\Test\TestCase;

class ExceptionTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $msg = 'Empty call stack';

        $exception = new Exception($msg);

        $this->setExpectedException(Exception::class, $msg);

        $exception();
    }
}
