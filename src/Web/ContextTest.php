<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\App;
use Mvc5\Http\Request\Config as Request;
use Mvc5\Http\Response\Config as Response;
use Mvc5\Service\Context as _Context;
use Mvc5\Test\Test\TestCase;
use Mvc5\Web\Context;

class ContextTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $app      = new App;
        $request  = new Request;
        $response = new Response;
        $web      = new Context($app);

        $next = function(Request $request, Response $response) {
            return $response;
        };

        $this->assertEquals($response, $web($request, $response, $next));
        $this->assertEquals($app, _Context::service());
    }
}
