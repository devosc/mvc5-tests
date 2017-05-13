<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\App;
use Mvc5\Http\HttpRequest;
use Mvc5\Http\HttpResponse;
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
        $request  = new HttpRequest;
        $response = new HttpResponse;
        $web      = new Context($app);

        $next = function(HttpRequest $request, HttpResponse $response) {
            return $response;
        };

        $this->assertEquals($response, $web($request, $response, $next));
        $this->assertEquals($app, _Context::service());
    }
}
