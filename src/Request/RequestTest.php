<?php
/**
 *
 */

namespace Mvc5\Test\Request;

use Mvc5\Arg;
use Mvc5\Request\Config as Request;
use Mvc5\Test\Test\TestCase;

class RequestTest
    extends TestCase
{
    /**
     *
     */
    function test_arg_default()
    {
        $request = new Request;

        $this->assertEquals('bar', $request->arg('foo', 'bar'));
    }

    /**
     *
     */
    function test_arg_not_null()
    {
        $request = new Request([Arg::ARGS => ['foo' => 'bar']]);

        $this->assertEquals('bar', $request->arg('foo'));
    }

    /**
     *
     */
    function test_arg_null()
    {
        $request = new Request;

        $this->assertNull($request->arg('foo'));
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
        $request = new Request([Arg::CONTROLLER => 'foo']);

        $this->assertEquals('foo', $request->controller());
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
    function test_data_default()
    {
        $request = new Request;

        $this->assertEquals('bar', $request->data('foo', 'bar'));
    }

    /**
     *
     */
    function test_data_null()
    {
        $request = new Request;

        $this->assertNull($request->data('foo'));
    }

    /**
     *
     */
    function test_error()
    {
        $request = new Request([Arg::ERROR => 'foo']);

        $this->assertEquals('foo', $request->error());
    }

    /**
     *
     */
    function test_files()
    {
        $request = new Request([Arg::FILES => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $request->files());
    }

    /**
     *
     */
    function test_files_not_set()
    {
        $request = new Request;

        $this->assertEquals([], $request->files());
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
     *
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
        $request = new Request([Arg::PARAMS => ['foo' => 'bar']]);

        $this->assertEquals('bar', $request->param('foo'));
    }

    /**
     *
     */
    function test_param_default()
    {
        $request = new Request;

        $this->assertEquals('bar', $request->param('foo', 'bar'));
    }

    /**
     *
     */
    function test_param_null()
    {
        $request = new Request;

        $this->assertNull($request->param('foo'));
    }

    /**
     *
     */
    function test_params()
    {
        $request = new Request([Arg::PARAMS => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $request->params());
    }

    /**
     *
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
    function test_post_default()
    {
        $request = new Request;

        $this->assertEquals('bar', $request->post('foo', 'bar'));
    }

    /**
     *
     */
    function test_post_null()
    {
        $request = new Request;

        $this->assertNull($request->post('foo'));
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

        $this->assertNull($request->port());
    }

    /**
     *
     */
    function test_query()
    {
        $request = new Request([Arg::URI => [Arg::QUERY => 'foo']]);

        $this->assertEquals('foo', $request->query());
    }

    /**
     *
     */
    function test_route()
    {
        $request = new Request([Arg::ROUTE => 'foo']);

        $this->assertEquals('foo', $request->route());
    }

    /**
     *
     */
    function test_route_not_exists()
    {
        $request = new Request;

        $this->assertNull($request->route());
    }

    /**
     *
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
    function test_server_param_default()
    {
        $request = new Request;

        $this->assertEquals('bar', $request->server('foo', 'bar'));
    }

    /**
     *
     */
    function test_server_param_null()
    {
        $request = new Request;

        $this->assertNull($request->server('foo'));
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
    function test_session_var_default()
    {
        $request = new Request;

        $this->assertEquals('bar', $request->session('foo', 'bar'));
    }

    /**
     *
     */
    function test_session_var_null()
    {
        $request = new Request;

        $this->assertNull($request->session('foo'));
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
     *
     */
    function test_user()
    {
        $request = new Request([Arg::USER => 'foo']);

        $this->assertEquals('foo', $request->user());
    }

    /**
     *
     */
    function test_user_agent()
    {
        $request = new Request([Arg::USER_AGENT => 'foo']);

        $this->assertEquals('foo', $request->userAgent());
    }

    /**
     *
     */
    function test_variable()
    {
        $request = new Request([
            Arg::PARAMS => ['foo' => 'bar'],
            Arg::ARGS   => ['bat' => 'baz'],
            Arg::DATA   => ['dir' => 'asc'],
        ]);

        $this->assertEquals('bar', $request->variable('foo'));
        $this->assertEquals('baz', $request->variable('bat'));
        $this->assertEquals('asc', $request->variable('dir'));
    }

    /**
     *
     */
    function test_variable_default()
    {
        $request = new Request;

        $this->assertEquals('bar', $request->variable('foo', 'bar'));
    }

    /**
     *
     */
    function test_variable_null()
    {
        $request = new Request;

        $this->assertNull($request->variable('foo'));
    }

    /**
     *
     */
    function test_variable_order()
    {
        $request = new Request([
            Arg::PARAMS => ['foo' => 'bar'],
            Arg::ARGS   => ['foo' => 'baz', 'bat' => 'bar'],
            Arg::DATA   => ['foo' => 'bat', 'bat' => 'baz', 'foobar' => 'bar'],
        ]);

        $this->assertEquals('bar', $request->variable('foo'));
        $this->assertEquals('bar', $request->variable('bat'));
        $this->assertEquals('bar', $request->variable('foobar'));
    }

    /**
     *
     */
    function test_vars()
    {
        $request = new Request([
            Arg::PARAMS => ['foo' => 'bar'],
            Arg::ARGS   => ['bat' => 'baz'],
            Arg::DATA   => ['dir' => 'asc'],
        ]);

        $this->assertEquals($request->params() + $request->args() + $request->data(), $request->vars());
    }
}
