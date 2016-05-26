<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\Arg;
use Mvc5\Http\Request\Config as Request;
use Mvc5\Http\Response\Config as Response;
use Mvc5\Web\Render;
use Mvc5\Test\Test\TestCase;
use Mvc5\Test\View\Template\HomeModel as Model;

class RenderTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $render = new Render;

        $request  = new Request;
        $response = new Response([Arg::BODY => new Model]);

        $next = function(Request $request, Response $response) {
            return $response;
        };

        $response = $render($request, $response, $next);

        $this->assertEquals('<h1>Home</h1>', trim($response[Arg::BODY]));
    }
}
