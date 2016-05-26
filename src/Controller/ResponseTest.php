<?php
/**
 *
 */

namespace Mvc5\Test\Controller;

use Mvc5\Controller\Response;
use Mvc5\Http\Request\Config as HttpRequest;
use Mvc5\Http\Response\Config as HttpResponse;
use Mvc5\Test\Test\TestCase;

class ResponseTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke_request()
    {
        $response = new Response('web', new HttpRequest, new HttpResponse);

        $result = $response(function($request) { return $request; });

        $this->assertInstanceOf(HttpRequest::class, $result);
        $this->assertFalse($response->stopped());
    }

    /**
     *
     */
    function test_invoke_response_not_stopped()
    {
        $response = new Response('web', new HttpRequest, new HttpResponse);

        $result = $response(function($response) { return $response; });

        $this->assertInstanceOf(HttpResponse::class, $result);
        $this->assertFalse($response->stopped());
    }

    /**
     *
     */
    function test_invoke_response_stopped()
    {
        $response = new Response('web', new HttpRequest, new HttpResponse);

        $result = $response(function($response) { return new HttpResponse; });

        $this->assertInstanceOf(HttpResponse::class, $result);
        $this->assertTrue($response->stopped());
    }

    /**
     *
     */
    function test_invoke_response_body()
    {
        $httpResponse = new HttpResponse;

        $response = new Response('web', new HttpRequest, $httpResponse);

        $result = $response(function() { return 'foo'; });

        $this->assertEquals('foo', $result);
        $this->assertEquals('foo', $httpResponse->body());
        $this->assertFalse($response->stopped());
    }
}
