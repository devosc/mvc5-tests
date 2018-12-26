<?php
/**
 *
 */

namespace Mvc5\Test\Session\CSRFToken;

use Mvc5\Session\CSRFToken\Generate;
use Mvc5\Session\PHPSession;
use Mvc5\Test\Test\TestCase;

/**
 * @runTestsInSeparateProcesses
 */
class GenerateTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $session = new PHPSession;

        $session->start();

        $this->assertEmpty($session['csrf_token']);

        (new Generate)($session);

        $token = $session['csrf_token'];

        $this->assertNotEmpty($token);

        (new Generate)($session);

        $this->assertEquals($token, $session['csrf_token']);
    }

    /**
     *
     */
    function test_override()
    {
        $session = new PHPSession;

        $session->start();

        (new Generate)($session);

        $token = $session['csrf_token'];

        $this->assertNotEmpty($token);

        (new Generate)($session, true);

        $this->assertNotEquals($token, $session['csrf_token']);
    }
}
