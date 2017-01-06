<?php
/**
 *
 */

namespace Mvc5\Test\Http;

use Mvc5\Arg;
use Mvc5\Http\Request\Config as Request;
use Mvc5\Test\Test\TestCase;

class RequestTest
    extends TestCase
{
    /**
     *
     */
    function test_body()
    {
        $request = new Request([Arg::BODY => 'foo']);

        $this->assertEquals('foo', $request->body());
    }

    /**
     *
     */
    function test_headers()
    {
        $request = new Request([Arg::HEADERS => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $request->headers());
    }

    /**
     *
     */
    function test_method()
    {
        $request = new Request([Arg::METHOD => 'GET']);

        $this->assertEquals('GET', $request->method());
    }

    /**
     *
     */
    function test_uri()
    {
        $request = new Request([Arg::URI => [Arg::PATH => 'foo']]);

        $this->assertEquals([Arg::PATH => 'foo'], $request->uri());
    }

    /**
     *
     */
    function test_version()
    {
        $request = new Request([Arg::VERSION => '1.1']);

        $this->assertEquals('1.1', $request->version());
    }

    /**
     *
     */
    function test_version_null()
    {
        $request = new Request;

        $this->assertNull($request->version());
    }
}
