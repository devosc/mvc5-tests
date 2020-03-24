<?php
/**
 *
 */

namespace Mvc5\Test\Http;

use Mvc5\Http\HttpUri;
use Mvc5\Http\Uri;
use Mvc5\Http\HttpRequest;
use Mvc5\Test\Test\TestCase;

use const Mvc5\{ BODY, HEADERS, METHOD, PATH, URI, VERSION };

class RequestTest
    extends TestCase
{
    /**
     *
     */
    function test_body()
    {
        $request = new HttpRequest([BODY => 'foo']);

        $this->assertEquals('foo', $request->body());
    }

    /**
     *
     */
    function test_headers()
    {
        $request = new HttpRequest([HEADERS => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $request->headers()->all());
    }

    /**
     *
     */
    function test_method()
    {
        $request = new HttpRequest([METHOD => 'GET']);

        $this->assertEquals('GET', $request->method());
    }

    /**
     *
     */
    function test_uri()
    {
        $request = new HttpRequest([URI => new HttpUri([PATH => 'foo'])]);

        $this->assertInstanceOf(Uri::class, $request->uri());

        $this->assertEquals('foo', $request->uri()['path']);
    }

    /**
     *
     */
    function test_uri_array()
    {
        $request = new HttpRequest([URI => [PATH => 'foo']]);

        $this->assertInstanceOf(Uri::class, $request->uri());

        $this->assertEquals('foo', $request->uri()['path']);
    }

    /**
     *
     */
    function test_uri_string()
    {
        $request = new HttpRequest([URI => 'foo']);

        $this->assertInstanceOf(Uri::class, $request->uri());

        $this->assertEquals('foo', $request->uri()['path']);
    }

    /**
     *
     */
    function test_uri_optional()
    {
        $request = new HttpRequest;

        $this->assertNull($request->uri());
    }

    /**
     *
     */
    function test_version()
    {
        $request = new HttpRequest([VERSION => '1.1']);

        $this->assertEquals('1.1', $request->version());
    }

    /**
     *
     */
    function test_version_null()
    {
        $request = new HttpRequest;

        $this->assertNull($request->version());
    }
}
