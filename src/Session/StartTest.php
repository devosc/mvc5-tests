<?php
/**
 *
 */

namespace Mvc5\Test\Session;

use Mvc5\Session\Start;
use Mvc5\Test\Test\TestCase;

class StartTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $this->assertInstanceOf(Start::class, new Start(['name' => 'PHPSESSID']));
    }

    /**
     *
     */
    function test_invoke_session_exists()
    {
        @session_start();

        $start = new Start;

        $this->assertTrue($start->__invoke());

        session_destroy();
    }

    /**
     *
     */
    function test_invoke()
    {
        $start = new Start(['name' => 'PHPSESSID']);

        $this->assertTrue(@$start->__invoke());

        session_destroy();
    }
}
