<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\Config;
use Mvc5\Http\Request\Config as Request;
use Mvc5\Http\Response\Config as Response;
use Mvc5\Web\Service;
use Mvc5\Test\Test\TestCase;

class ServiceTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $service = new Service(new Config);

        $request  = new Request;
        $response = new Response;

        $next = function(Request $request, Response $response) {
            return $response;
        };

        $this->assertEquals($response, $service($request, $response, $next));
    }
}
