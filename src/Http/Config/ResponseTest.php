<?php
/**
 *
 */

namespace Mvc5\Test\Http\Config;

use Mvc5\Arg;
use Mvc5\Http\Response\Config as Response;
use Mvc5\Test\Test\TestCase;

class ResponseTest
    extends TestCase
{
    /**
     * @return string
     */
    function test_body()
    {
        $response = new Response([Arg::BODY => 'foo']);

        $this->assertEquals('foo', $response->body());
    }

    /**
     * @return string
     */
    function test_headers()
    {
        $response = new Response([Arg::HEADERS => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $response->headers());
    }

    /**
     * @return int
     */
    function test_reason()
    {
        $response = new Response([Arg::REASON => 'foo']);

        $this->assertEquals('foo', $response->reason());
    }

    /**
     * @return int
     */
    function test_version()
    {
        $response = new Response([Arg::VERSION => '1.1']);

        $this->assertEquals('1.1', $response->version());
    }

    /**
     * @return int
     */
    function test_status()
    {
        $response = new Response([Arg::STATUS => '200']);

        $this->assertEquals('200', $response->status());
    }
}
