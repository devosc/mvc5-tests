<?php
/**
 *
 */

namespace Mvc5\Test\Log;

use Mvc5\Log\ErrorLog;
use Mvc5\Test\Test\TestCase;

class ErrorTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $log = new ErrorLog;

        $this->assertTrue($log('Hello!'));
    }
}
