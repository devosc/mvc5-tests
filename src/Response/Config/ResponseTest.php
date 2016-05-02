<?php
/**
 *
 */

namespace Mvc5\Test\Response\Config;

use Mvc5\Arg;
use Mvc5\Cookie\Container as CookieJar;
use Mvc5\Response\Headers\Config as ResponseHeaders;
use Mvc5\Response\Config as Response;
use Mvc5\Test\Test\TestCase;

class ResponseTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $response = new Response;

        $this->assertEquals(null,                $response->body());
        $this->assertEquals(new CookieJar,       $response->cookies());
        $this->assertEquals(new ResponseHeaders, $response->headers());
        $this->assertEquals(Arg::HTTP_OK,        $response->status());
    }

    /**
     *
     */
    function test_cookie_set()
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
    function test_set_header()
    {
        $response = new Response;

        $response->header('foo', 'bar');

        $this->assertEquals(new ResponseHeaders(['foo' => 'bar']), $response->headers());
    }

    /**
     *
     */
    function test_set_header_replace()
    {
        $response = new Response;

        $response->header('foo', 'bar');

        $this->assertEquals(new ResponseHeaders(['foo' => 'bar']), $response->headers());

        $response->header('foo', 'baz', true);

        $this->assertEquals(new ResponseHeaders(['foo' => 'baz']), $response->headers());
    }
}
