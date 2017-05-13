<?php
/**
 *
 */

namespace Mvc5\Test\Response;

use Mvc5\Http\HttpCookies;
use Mvc5\Http\HttpHeaders;
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

        $this->assertNull($response->body());
        $this->assertEquals(new HttpCookies, $response->cookies());
        $this->assertEquals(new HttpHeaders, $response->headers());
        $this->assertNull($response->status());
    }

    /**
     *
     */
    function test_set_cookie()
    {
        $response = new Response;

        $new = $response->withCookie('foo', 'bar');

        $this->assertFalse($response->cookies()->has('foo'));
        $this->assertTrue($new->cookies()->has('foo'));
    }

    /**
     *
     */
    function test_cookies()
    {
        $response = new Response(null, null, [], ['cookies' => ['foo' => 'bar']]);

        $this->assertEquals(new HttpCookies(['foo' => 'bar']), $response->cookies());
    }

    /**
     *
     */
    function test_set_cookies()
    {
        $response = new Response;

        $new = $response->withCookies(['foo']);

        $this->assertEquals(new HttpCookies, $response->cookies());
        $this->assertEquals(new HttpCookies(['foo']), $new->cookies());
    }

    /**
     *
     */
    function test_set_header()
    {
        $response = new Response;

        $new = $response->withHeader('foo', 'bar');

        $this->assertEquals(new HttpHeaders, $response->headers());
        $this->assertEquals(new HttpHeaders(['foo' => 'bar']), $new->headers());
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

        $new = $response->withHeaders(['foo' => 'bar']);

        $this->assertEquals(new HttpHeaders, $response->headers());
        $this->assertEquals(new HttpHeaders(['foo' => 'bar']), $new->headers());
    }

    /**
     *
     */
    function test_status()
    {
        $response = new Response;

        $new = $response->withStatus('404');

        $this->assertNull($response->status());
        $this->assertEquals('404', $new->status());
    }

    /**
     *
     */
    function test_version()
    {
        $response = new Response;

        $new = $response->withVersion('1.1');

        $this->assertNull($response->version());
        $this->assertEquals('1.1', $new->version());
    }
}
