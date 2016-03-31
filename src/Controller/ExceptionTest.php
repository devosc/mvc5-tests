<?php
/**
 *
 */

namespace Mvc5\Test\Controller;

use Mvc5\Arg;
use Mvc5\Controller\Exception;
use Mvc5\Test\Test\TestCase;

class Test
    extends TestCase
{
    /**
     *
     */
    public function test_invoke()
    {
        $e         = new \Exception;
        $exception = new Exception([]);

        $this->assertEquals($e, $exception($e)[Arg::EXCEPTION]);
    }
}
