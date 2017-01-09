<?php
/**
 *
 */

namespace Mvc5\Test\Http;

use Mvc5\Arg;
use Mvc5\Http\Response\Config as Response;
use Mvc5\Test\Test\TestCase;

class ResponseTest
    extends TestCase
{
    /**
     *
     */
    function test_body()
    {
        $response = new Response([Arg::BODY => 'foo']);

        $this->assertEquals('foo', $response->body());
    }

    /**
     *
     */
    function test_headers()
    {
        $response = new Response([Arg::HEADERS => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $response->headers());
    }

    /**
     *
     */
    function test_reason()
    {
        $response = new Response([Arg::REASON => 'foo']);

        $this->assertEquals('foo', $response->reason());
    }

    /**
     *
     */
    function test_status()
    {
        $response = new Response([Arg::STATUS => '200']);

        $this->assertEquals('200', $response->status());
    }

    /**
     *
     */
    function test_status_null()
    {
        $response = new Response;

        $this->assertNull($response->status());
    }

    /**
     *
     */
    function test_version()
    {
        $response = new Response([Arg::VERSION => '1.1']);

        $this->assertEquals('1.1', $response->version());
    }

    /**
     *
     */
    function test_version_null()
    {
        $response = new Response;

        $this->assertNull($response->version());
    }
}
