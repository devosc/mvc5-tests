<?php
/**
 *
 */

namespace Mvc5\Test\Http\Config;

use Mvc5\Arg;
use Mvc5\Http\Request\Config as Request;
use Mvc5\Test\Test\TestCase;

class RequestTest
    extends TestCase
{
    /**
     * @return string
     */
    function test_body()
    {
        $request = new Request([Arg::BODY => 'foo']);

        $this->assertEquals('foo', $request->body());
    }

    /**
     * @return string
     */
    function test_headers()
    {
        $request = new Request([Arg::HEADERS => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $request->headers());
    }

    /**
     * @return string|string[]
     */
    function test_method()
    {
        $request = new Request([Arg::METHOD => 'GET']);

        $this->assertEquals('GET', $request->method());
    }

    /**
     * @return mixed
     */
    function test_uri()
    {
        $request = new Request([Arg::URI => [Arg::PATH => 'foo']]);

        $this->assertEquals([Arg::PATH => 'foo'], $request->uri());
    }

    /**
     * @return int
     */
    function test_version()
    {
        $request = new Request([Arg::VERSION => '1.1']);

        $this->assertEquals('1.1', $request->version());
    }
}
