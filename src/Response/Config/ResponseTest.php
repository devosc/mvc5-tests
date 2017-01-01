<?php
/**
 *
 */

namespace Mvc5\Test\Response\Config;

use Mvc5\Cookie\Container as CookieJar;
use Mvc5\Http\Headers\Config as HttpHeaders;
use Mvc5\Response\Config as Response;
use Mvc5\Test\Test\TestCase;

class ResponseTest
    extends TestCase
{
    /**
     *
     */
    function test_default_values()
    {
        $response = new Response;

        $this->assertEquals(null,            $response->body());
        $this->assertEquals(new CookieJar,   $response->cookies());
        $this->assertEquals(new HttpHeaders, $response->headers());
        $this->assertEquals(null,            $response->status());
    }

    /**
     *
     */
    function test_array_headers()
    {
        $response = new Response(null, null, ['foo' => 'bar']);

        $this->assertEquals(new HttpHeaders(['foo' => 'bar']), $response->headers());
    }

    /**
     *
     */
    function test_set_cookie()
    {
        $response = new Response;

        $response->cookie('foo', 'bar');

        $this->assertTrue($response->cookies()->has('foo'));
    }

    /**
     *
     */
    function test_cookies()
    {
        $response = new Response(null, null, [], ['cookies' => ['foo']]);

        $this->assertEquals(['foo'], $response->cookies());
    }

    /**
     *
     */
    function test_set_cookies()
    {
        $response = new Response;

        $this->assertEquals(['foo'], $response->cookies(['foo']));
    }

    /**
     *
     */
    function test_set_header()
    {
        $response = new Response;

        $response->header('foo', 'bar');

        $this->assertEquals(new HttpHeaders(['foo' => 'bar']), $response->headers());
    }

    /**
     *
     */
    function test_headers()
    {
        $response = new Response(null, null, ['foo' => 'bar']);

        $this->assertEquals(new HttpHeaders(['foo' => 'bar']), $response->headers());
    }

    /**
     *
     */
    function test_set_headers()
    {
        $response = new Response;

        $this->assertEquals(['foo' => 'bar'], $response->headers(['foo' => 'bar']));
    }

    /**
     *
     */
    function test_status()
    {
        $response = new Response;

        $this->assertEquals('200', $response->status('200'));
    }

    /**
     *
     */
    function test_version()
    {
        $response = new Response;

        $this->assertEquals('1.1', $response->status('1.1'));
    }
}
