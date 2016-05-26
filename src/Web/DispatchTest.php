<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\App;
use Mvc5\Http\Request\Config as Request;
use Mvc5\Http\Response\Config as Response;
use Mvc5\Test\Test\TestCase;
use Mvc5\Web\Dispatch;

class DispatchTest
    extends TestCase
{
    /**
     *
     */
    function test_dispatch_web_response()
    {
        $app = new App([
            'services' => [
                'web\response' => function() {
                    return function(Request $request, Response $response) {
                        return $response;
                    };
                }
            ]
        ]);

        $dispatch = new Dispatch;
        $dispatch->service($app);

        $request  = new Request;
        $response = new Response;

        $next = function(Request $request, Response $response) {
            return $response;
        };

        $this->assertEquals($response, $dispatch($request, $response, $next));
    }
}
