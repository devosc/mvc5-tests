<?php
/**
 *
 */

namespace Mvc5\Test\Request\Config;

use Mvc5\Arg;
use Mvc5\Request\Config as Request;
use Mvc5\Test\Test\TestCase;

class RequestTest
    extends TestCase
{
    /**
     *
     */
    function test_arg_not_null()
    {
        $route = new Request([Arg::ARGS => ['foo' => 'bar']]);

        $this->assertEquals('bar', $route->arg('foo'));
    }

    /**
     *
     */
    function test_arg_null()
    {
        $route = new Request;

        $this->assertEquals(null, $route->arg('foo'));
    }

    /**
     *
     */
    function test_args()
    {
        $request = new Request([Arg::ARGS => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $request->args());
    }

    /**
     *
     */
    function test_args_empty()
    {
        $request = new Request;

        $this->assertEquals([], $request->args());
    }

    /**
     *
     */
    function test_attr()
    {
        $request = new Request;

        $request->attr('foo', 'bar');

        $this->assertEquals('bar', $request->param('foo'));
    }

    /**
     * @return mixed
     */
    function test_client_address()
    {
        $request = new Request([Arg::CLIENT_ADDRESS => 'foo']);

        $this->assertEquals('foo', $request->clientAddress());
    }

    /**
     *
     */
    function test_content_type()
    {
        $request = new Request([Arg::CONTENT_TYPE => 'foo']);

        $this->assertEquals('foo', $request->contentType());
    }

    /**
     *
     */
    function test_controller()
    {
        $route = new Request([Arg::CONTROLLER => 'foo']);

        $this->assertEquals('foo', $route->controller());
    }

    /**
     *
     */
    function test_cookie()
    {
        $request = new Request([Arg::COOKIES => ['foo' => 'bar']]);

        $this->assertEquals('bar', $request->cookie('foo'));
    }

    /**
     *
     */
    function test_cookies()
    {
        $request = new Request([Arg::COOKIES => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $request->cookies());
    }

    /**
     *
     */
    function test_data()
    {
        $request = new Request([Arg::DATA => ['foo' => 'bar']]);

        $this->assertEquals('bar', $request->data('foo'));
    }

    /**
     *
     */
    function test_error()
    {
        $route = new Request([Arg::ERROR => 'foo']);;

        $this->assertEquals('foo', $route->error());
    }

    /**
     *
     */
    function test_files()
    {
        $route = new Request([Arg::FILES => ['foo' => 'bar']]);;

        $this->assertEquals(['foo' => 'bar'], $route->files());
    }

    /**
     *
     */
    function test_header()
    {
        $request = new Request([Arg::HEADERS => ['foo' => 'bar']]);

        $this->assertEquals('bar', $request->header('foo'));
    }

    /**
     * @return string|string[]
     */
    function test_host()
    {
        $request = new Request([Arg::URI => [Arg::HOST => 'foo']]);

        $this->assertEquals('foo', $request->host());
    }

    /**
     *
     */
    function test_is_post()
    {
        $request = new Request([Arg::METHOD => 'POST']);

        $this->assertTrue($request->isPost());
    }

    /**
     *
     */
    function test_is_secure()
    {
        $request = new Request([Arg::URI => [Arg::SCHEME => 'https']]);

        $this->assertTrue($request->isSecure());
    }

    /**
     *
     */
    function test_is_xml_http_request()
    {
        $request = new Request([Arg::HEADERS => ['X-Requested-With' => 'XMLHttpRequest']]);

        $this->assertTrue($request->isXmlHttpRequest());
    }

    /**
     *
     */
    function test_name()
    {
        $request = new Request([Arg::NAME => 'foo']);

        $this->assertEquals('foo', $request->name());
    }

    /**
     *
     */
    function test_param()
    {
        $request = new Request([
            Arg::PARAMS => ['foo' => 'bar'],
            Arg::ARGS   => ['bat' => 'baz'],
            Arg::DATA   => ['dir' => 'asc'],
        ]);

        $this->assertEquals('bar', $request->param('foo'));
        $this->assertEquals('baz', $request->param('bat'));
        $this->assertEquals('asc', $request->param('dir'));
    }

    /**
     *
     */
    function test_params()
    {
        $request = new Request([
            Arg::PARAMS => ['foo' => 'bar'],
            Arg::ARGS   => ['bat' => 'baz'],
            Arg::DATA   => ['dir' => 'asc'],
        ]);

        $this->assertEquals($request->params() + $request->args() + $request->data(), $request->params());
    }

    /**
     * @return string
     */
    function test_path()
    {
        $request = new Request([Arg::URI => [Arg::PATH => 'foo']]);

        $this->assertEquals('foo', $request->path());
    }

    /**
     *
     */
    function test_post()
    {
        $request = new Request([Arg::DATA => ['foo' => 'bar']]);

        $this->assertEquals('bar', $request->post('foo'));
    }

    /**
     *
     */
    function test_port_exists()
    {
        $request = new Request([Arg::URI => [Arg::PORT => '80']]);

        $this->assertEquals('80', $request->port());
    }

    /**
     *
     */
    function test_port_not_exists()
    {
        $request = new Request;

        $this->assertEquals(null, $request->port());
    }

    /**
     * @return string
     */
    function test_query()
    {
        $request = new Request([Arg::URI => [Arg::QUERY => 'foo']]);

        $this->assertEquals('foo', $request->query());
    }

    /**
     * @return string|string[]
     */
    function test_scheme()
    {
        $request = new Request([Arg::URI => [Arg::SCHEME => 'http']]);

        $this->assertEquals('http', $request->scheme());
    }

    /**
     *
     */
    function test_server()
    {
        $request = new Request([Arg::SERVER => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $request->server());
    }

    /**
     *
     */
    function test_server_param()
    {
        $request = new Request([Arg::SERVER => ['foo' => 'bar']]);

        $this->assertEquals('bar', $request->server('foo'));
    }

    /**
     *
     */
    function test_session()
    {
        $request = new Request([Arg::SESSION => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $request->session());
    }

    /**
     *
     */
    function test_session_var()
    {
        $request = new Request([Arg::SESSION => ['foo' => 'bar']]);

        $this->assertEquals('bar', $request->session('foo'));
    }

    /**
     *
     */
    function test_stream()
    {
        $request = new Request([Arg::STREAM => 'foo']);

        $this->assertEquals('foo', $request->stream());
    }

    /**
     * @return string
     */
    function test_user()
    {
        $request = new Request([Arg::USER => 'foo']);

        $this->assertEquals('foo', $request->user());
    }

    /**
     * @return string
     */
    function test_user_agent()
    {
        $request = new Request([Arg::USER_AGENT => 'foo']);

        $this->assertEquals('foo', $request->userAgent());
    }
}
