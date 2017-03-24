<?php
/**
 *
 */

namespace Mvc5\Test\Response;

use Mvc5\Http\Cookies\Config as HttpCookies;
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

        $new = $response->cookie('foo', 'bar');

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

        $new = $response->cookies(['foo']);

        $this->assertEquals(new HttpCookies, $response->cookies());
        $this->assertEquals(new HttpCookies(['foo']), $new->cookies());
    }

    /**
     *
     */
    function test_set_header()
    {
        $response = new Response;

        $new = $response->header('foo', 'bar');

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

        $new = $response->headers(['foo' => 'bar']);

        $this->assertEquals(new HttpHeaders, $response->headers());
        $this->assertEquals(new HttpHeaders(['foo' => 'bar']), $new->headers());
    }

    /**
     *
     */
    function test_status()
    {
        $response = new Response;

        $new = $response->status('404');

        $this->assertNull($response->status());
        $this->assertEquals('404', $new->status());
    }

    /**
     *
     */
    function test_version()
    {
        $response = new Response;

        $new = $response->status('1.1');

        $this->assertNull($response->status());
        $this->assertEquals('1.1', $new->status());
    }
}
