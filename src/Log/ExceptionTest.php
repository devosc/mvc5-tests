<?php
/**
 *
 */

namespace Mvc5\Test\Log;

use Mvc5\Log\Error as Log;
use Mvc5\Log\Exception;
use Mvc5\Test\Test\TestCase;

class ExceptionTest
    extends TestCase
{
    /**
     *
     */
    function test_log_exception()
    {
        $log = new Exception(new Log);

        $this->assertTrue($log(new \Exception('Hello!')));
    }
}
