<?php
/**
 *
 */

namespace Mvc5\Test\Session\Login;

use Mvc5\Http\HttpRedirect;
use Mvc5\Http\HttpRequest;
use Mvc5\Session\Login\Redirect;
use Mvc5\Session\PHPSession;
use Mvc5\Test\Test\TestCase;

/**
 * @runTestsInSeparateProcesses
 */
class RedirectTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $session = new PHPSession;
        $session->start();

        $redirect = new HttpRedirect('/login');

        $controller = new Redirect($session, $redirect);

        $response = $controller(new HttpRequest(['uri' => ['path' => '/']]));

        $this->assertEquals($redirect, $response);
    }
}
