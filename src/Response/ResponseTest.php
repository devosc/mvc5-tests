<?php
/**
 *
 */

namespace Mvc5\Test\Response;

use Mvc5\Cookie\HttpCookies;
use Mvc5\Http\HttpHeaders;
use Mvc5\Response\HttpResponse;
use Mvc5\Test\Test\TestCase;

class ResponseTest
    extends TestCase
{
    /**
     *
     */
    function test_default_values()
    {
        $response = new HttpResponse;

        $this->assertNull($response->body());
        $this->assertEquals(new HttpCookies, $response->cookies());
        $this->assertEquals(new HttpHeaders, $response->headers());
        $this->assertNull($response->status());
    }

    /**
     *
     */
    function test_with_cookie()
    {
        $response = new HttpResponse;

        $new = $response->withCookie('foo', 'bar');

        $this->assertFalse($response->cookies()->has('foo'));
        $this->assertTrue($new->cookies()->has('foo'));
    }

    /**
     *
     */
    function test_cookies()
    {
        $response = new HttpResponse(null, null, [], ['cookies' => ['foo' => ['foo', 'bar']]]);

        $this->assertEquals(new HttpCookies(['foo' => ['foo', 'bar']]), $response->cookies());
    }

    /**
     *
     */
    function test_with_cookies()
    {
        $response = new HttpResponse;

        $new = $response->withCookies(['foo' => ['foo', 'bar']]);

        $this->assertEquals(new HttpCookies, $response->cookies());
        $this->assertEquals(new HttpCookies(['foo' => ['foo', 'bar']]), $new->cookies());
    }

    /**
     *
     */
    function test_with_header()
    {
        $response = new HttpResponse;

        $new = $response->withHeader('foo', 'bar');

        $this->assertEquals(new HttpHeaders, $response->headers());
        $this->assertEquals(new HttpHeaders(['foo' => 'bar']), $new->headers());
    }

    /**
     *
     */
    function test_header()
    {
        $response = new HttpResponse(null, null, ['foo' => 'bar', 'baz' => 'bat', 'foobar' => ['foo', 'bar', 'bat']]);

        $this->assertEquals('bar', $response->header('foo'));
        $this->assertEquals(['foo' => 'bar', 'baz' => 'bat', 'foobar' => 'foo, bar, bat'], $response->header(['foo', 'baz', 'foobar']));
        $this->assertEquals('foo, bar, bat', $response->header('foobar'));
    }

    /**
     *
     */
    function test_headers()
    {
        $response = new HttpResponse(null, null, ['foo' => 'bar']);

        $this->assertEquals(new HttpHeaders(['foo' => 'bar']), $response->headers());
    }

    /**
     *
     */
    function test_with_headers()
    {
        $response = new HttpResponse;

        $new = $response->withHeaders(['foo' => 'bar']);

        $this->assertEquals(new HttpHeaders, $response->headers());
        $this->assertEquals(new HttpHeaders(['foo' => 'bar']), $new->headers());
    }

    /**
     *
     */
    function test_status()
    {
        $response = new HttpResponse;

        $new = $response->withStatus('404');

        $this->assertNull($response->status());
        $this->assertEquals('404', $new->status());
    }

    /**
     *
     */
    function test_version()
    {
        $response = new HttpResponse;

        $new = $response->withVersion('1.1');

        $this->assertNull($response->version());
        $this->assertEquals('1.1', $new->version());
    }
}
