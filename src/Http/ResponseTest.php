<?php
/**
 *
 */

namespace Mvc5\Test\Http;

use Mvc5\Arg;
use Mvc5\Http\HttpHeaders;
use Mvc5\Http\HttpResponse;
use Mvc5\Test\Test\TestCase;

class ResponseTest
    extends TestCase
{
    /**
     *
     */
    function test_body()
    {
        $response = new HttpResponse([Arg::BODY => 'foo']);

        $this->assertEquals('foo', $response->body());
    }

    /**
     *
     */
    function test_headers()
    {
        $response = new HttpResponse([Arg::HEADERS => new HttpHeaders(['foo' => 'bar'])]);

        $this->assertEquals(['foo' => 'bar'], $response->headers()->all());
    }

    /**
     *
     */
    function test_headers_array()
    {
        $response = new HttpResponse([Arg::HEADERS => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $response->headers()->all());
    }

    /**
     *
     */
    function test_reason()
    {
        $response = new HttpResponse([Arg::REASON => 'foo']);

        $this->assertEquals('foo', $response->reason());
    }

    /**
     *
     */
    function test_status()
    {
        $response = new HttpResponse([Arg::STATUS => 200]);

        $this->assertEquals(200, $response->status());
    }

    /**
     *
     */
    function test_status_null()
    {
        $response = new HttpResponse;

        $this->assertNull($response->status());
    }

    /**
     *
     */
    function test_version()
    {
        $response = new HttpResponse([Arg::VERSION => '1.1']);

        $this->assertEquals('1.1', $response->version());
    }

    /**
     *
     */
    function test_version_null()
    {
        $response = new HttpResponse;

        $this->assertNull($response->version());
    }
}
