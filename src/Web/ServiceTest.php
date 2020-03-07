<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\Config;
use Mvc5\Http\HttpRequest;
use Mvc5\Http\HttpResponse;
use Mvc5\Test\Test\TestCase;
use Mvc5\Web\Service;

class ServiceTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $service = new Service(new Config);

        $request  = new HttpRequest;
        $response = new HttpResponse;

        $next = fn(HttpRequest $request, HttpResponse $response) => $response;

        $this->assertEquals($response, $service($request, $response, $next));
    }
}
