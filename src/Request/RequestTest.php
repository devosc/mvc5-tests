<?php
/**
 *
 */

namespace Mvc5\Test\Request;

use Mvc5\Arg;
use Mvc5\Http\Error;
use Mvc5\Http\Error\NotFound;
use Mvc5\Request\HttpRequest;
use Mvc5\Route\Config as Mvc5Route;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;

class RequestTest
    extends TestCase
{
    /**
     *
     */
    function test_arg_default()
    {
        $request = new HttpRequest;

        $this->assertEquals('bar', $request->arg('foo', 'bar'));
    }

    /**
     *
     */
    function test_arg_not_null()
    {
        $request = new HttpRequest([Arg::ARGS => ['foo' => 'bar', 'baz' => 'bat']]);

        $this->assertEquals('bar', $request->arg('foo'));
        $this->assertEquals(['foo' => 'bar', 'baz' => 'bat'], $request->arg(['foo', 'baz']));
    }

    /**
     *
     */
    function test_arg_null()
    {
        $request = new HttpRequest;

        $this->assertNull($request->arg('foo'));
    }

    /**
     *
     */
    function test_args()
    {
        $request = new HttpRequest([Arg::ARGS => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $request->args());
    }

    /**
     *
     */
    function test_args_empty()
    {
        $request = new HttpRequest;

        $this->assertEquals([], $request->args());
    }

    /**
     *
     */
    function test_client_address()
    {
        $request = new HttpRequest([Arg::CLIENT_ADDRESS => 'foo']);

        $this->assertEquals('foo', $request->clientAddress());
    }

    /**
     *
     */
    function test_controller()
    {
        $request = new HttpRequest([Arg::CONTROLLER => 'foo']);

        $this->assertEquals('foo', $request->controller());
    }

    /**
     *
     */
    function test_cookie()
    {
        $request = new HttpRequest([Arg::COOKIES => ['foo' => 'bar', 'baz' => 'bat']]);

        $this->assertEquals('bar', $request->cookie('foo'));
        $this->assertEquals(['foo' => 'bar', 'baz' => 'bat'], $request->cookie(['foo', 'baz']));
    }

    /**
     *
     */
    function test_cookies()
    {
        $request = new HttpRequest([Arg::COOKIES => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $request->cookies());
    }

    /**
     *
     */
    function test_data()
    {
        $data = ['foo' => 'bar', 'baz' => 'bat', 'foobar' => 'home'];

        $request = new HttpRequest([Arg::DATA => $data]);

        $this->assertEquals($data, $request->data());
        $this->assertEquals('bar', $request->data('foo'));
        $this->assertEquals(['foo' => 'bar', 'baz' => 'bat'], $request->data(['foo', 'baz']));
    }

    /**
     *
     */
    function test_data_default()
    {
        $request = new HttpRequest;

        $this->assertEquals('bar', $request->data('foo', 'bar'));
    }

    /**
     *
     */
    function test_data_null()
    {
        $request = new HttpRequest;

        $this->assertNull($request->data('foo'));
    }

    /**
     *
     */
    function test_error()
    {
        $request = new HttpRequest([Arg::ERROR => new NotFound]);

        $this->assertInstanceOf(Error::class, $request->error());
    }

    /**
     *
     */
    function test_files()
    {
        $request = new HttpRequest([Arg::FILES => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $request->files());
    }

    /**
     *
     */
    function test_files_not_set()
    {
        $request = new HttpRequest;

        $this->assertEquals([], $request->files());
    }

    /**
     *
     */
    function test_header()
    {
        $request = new HttpRequest([Arg::HEADERS => ['foo' => 'bar', 'baz' => 'bat']]);

        $this->assertEquals('bar', $request->header('foo'));
        $this->assertEquals(['foo' => 'bar', 'baz' => 'bat'], $request->header(['foo', 'baz']));
    }

    /**
     *
     */
    function test_host()
    {
        $request = new HttpRequest([Arg::URI => [Arg::HOST => 'foo']]);

        $this->assertEquals('foo', $request->host());
    }

    /**
     *
     */
    function test_is_post()
    {
        $request = new HttpRequest([Arg::METHOD => 'POST']);

        $this->assertTrue($request->isPost());
    }

    /**
     *
     */
    function test_is_secure()
    {
        $request = new HttpRequest([Arg::URI => [Arg::SCHEME => 'https']]);

        $this->assertTrue($request->isSecure());
    }

    /**
     *
     */
    function test_is_xml_http_request()
    {
        $request = new HttpRequest([Arg::HEADERS => ['X-Requested-With' => 'XMLHttpRequest']]);

        $this->assertTrue($request->isXmlHttpRequest());
    }

    /**
     *
     */
    function test_name()
    {
        $request = new HttpRequest([Arg::NAME => 'foo']);

        $this->assertEquals('foo', $request->name());
    }

    /**
     *
     */
    function test_param()
    {
        $request = new HttpRequest([Arg::PARAMS => ['foo' => 'bar', 'baz' => 'bat']]);

        $this->assertEquals('bar', $request->param('foo'));
        $this->assertEquals(['foo' => 'bar', 'baz' => 'bat'], $request->param(['foo', 'baz']));
    }

    /**
     *
     */
    function test_param_default()
    {
        $request = new HttpRequest;

        $this->assertEquals('bar', $request->param('foo', 'bar'));
    }

    /**
     *
     */
    function test_param_null()
    {
        $request = new HttpRequest;

        $this->assertNull($request->param('foo'));
    }

    /**
     *
     */
    function test_params()
    {
        $request = new HttpRequest([Arg::PARAMS => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $request->params());
    }

    /**
     *
     */
    function test_path()
    {
        $request = new HttpRequest([Arg::URI => [Arg::PATH => 'foo']]);

        $this->assertEquals('foo', $request->path());
    }

    /**
     *
     */
    function test_post()
    {
        $data = ['foo' => 'bar', 'baz' => 'bat', 'foobar' => 'home'];

        $request = new HttpRequest([Arg::DATA => $data]);

        $this->assertEquals($data, $request->post());
        $this->assertEquals('bar', $request->post('foo'));
        $this->assertEquals(['foo' => 'bar', 'baz' => 'bat'], $request->post(['foo', 'baz']));
    }

    /**
     *
     */
    function test_post_default()
    {
        $request = new HttpRequest;

        $this->assertEquals('bar', $request->post('foo', 'bar'));
    }

    /**
     *
     */
    function test_post_null()
    {
        $request = new HttpRequest;

        $this->assertNull($request->post('foo'));
    }

    /**
     *
     */
    function test_port_exists()
    {
        $request = new HttpRequest([Arg::URI => [Arg::PORT => 80]]);

        $this->assertEquals(80, $request->port());
    }

    /**
     *
     */
    function test_port_not_exists()
    {
        $request = new HttpRequest;

        $this->assertNull($request->port());
    }

    /**
     *
     */
    function test_query()
    {
        $request = new HttpRequest([Arg::URI => [Arg::QUERY => 'foo']]);

        $this->assertEquals('foo', $request->query());
    }

    /**
     *
     */
    function test_route()
    {
        $request = new HttpRequest([Arg::ROUTE => new Mvc5Route]);

        $this->assertInstanceOf(Route::class, $request->route());
    }

    /**
     *
     */
    function test_route_not_exists()
    {
        $request = new HttpRequest;

        $this->assertNull($request->route());
    }

    /**
     *
     */
    function test_scheme()
    {
        $request = new HttpRequest([Arg::URI => [Arg::SCHEME => 'http']]);

        $this->assertEquals('http', $request->scheme());
    }

    /**
     *
     */
    function test_server()
    {
        $data = ['foo' => 'bar', 'baz' => 'bat', 'foobar' => 'home'];

        $request = new HttpRequest([Arg::SERVER => $data]);

        $this->assertEquals($data, $request->server());
        $this->assertEquals('bar', $request->server('foo'));
        $this->assertEquals(['foo' => 'bar', 'baz' => 'bat'], $request->server(['foo', 'baz']));
    }

    /**
     *
     */
    function test_server_param_default()
    {
        $request = new HttpRequest;

        $this->assertEquals('bar', $request->server('foo', 'bar'));
    }

    /**
     *
     */
    function test_server_param_null()
    {
        $request = new HttpRequest;

        $this->assertNull($request->server('foo'));
    }

    /**
     *
     */
    function test_session()
    {
        $data = ['foo' => 'bar', 'baz' => 'bat', 'foobar' => 'home'];

        $request = new HttpRequest([Arg::SESSION => $data]);

        $this->assertEquals($data, $request->session());
        $this->assertEquals('bar', $request->session('foo'));
        $this->assertEquals(['foo' => 'bar', 'baz' => 'bat'], $request->session(['foo', 'baz']));
    }

    /**
     *
     */
    function test_session_var_default()
    {
        $request = new HttpRequest;

        $this->assertEquals('bar', $request->session('foo', 'bar'));
    }

    /**
     *
     */
    function test_session_var_null()
    {
        $request = new HttpRequest;

        $this->assertNull($request->session('foo'));
    }

    /**
     *
     */
    function test_user()
    {
        $request = new HttpRequest([Arg::USER => 'foo']);

        $this->assertEquals('foo', $request->user());
    }

    /**
     *
     */
    function test_user_agent()
    {
        $request = new HttpRequest([Arg::USER_AGENT => 'foo']);

        $this->assertEquals('foo', $request->userAgent());
    }

    /**
     *
     */
    function test_variable()
    {
        $request = new HttpRequest([
            Arg::PARAMS => ['foo' => 'bar'],
            Arg::ARGS   => ['bat' => 'baz'],
            Arg::DATA   => ['dir' => 'asc'],
        ]);

        $this->assertEquals('bar', $request->var('foo'));
        $this->assertEquals('baz', $request->var('bat'));
        $this->assertEquals('asc', $request->var('dir'));
        $this->assertEquals(['foo' => 'bar', 'bat' => 'baz', 'dir' => 'asc'], $request->var(['foo', 'bat', 'dir']));
    }

    /**
     *
     */
    function test_variable_default()
    {
        $request = new HttpRequest;

        $this->assertEquals('bar', $request->var('foo', 'bar'));
    }

    /**
     *
     */
    function test_variable_null()
    {
        $request = new HttpRequest;

        $this->assertNull($request->var('foo'));
    }

    /**
     *
     */
    function test_variable_order()
    {
        $request = new HttpRequest([
            Arg::PARAMS => ['foo' => 'bar'],
            Arg::ARGS   => ['foo' => 'baz', 'bat' => 'bar'],
            Arg::DATA   => ['foo' => 'bat', 'bat' => 'baz', 'foobar' => 'bar'],
        ]);

        $this->assertEquals('bar', $request->var('foo'));
        $this->assertEquals('bar', $request->var('bat'));
        $this->assertEquals('bar', $request->var('foobar'));
        $this->assertEquals(['foo' => 'bar', 'bat' => 'bar', 'foobar' => 'bar'], $request->var(['foo', 'bat', 'foobar']));
    }

    /**
     *
     */
    function test_vars()
    {
        $request = new HttpRequest([
            Arg::PARAMS => ['foo' => 'bar'],
            Arg::ARGS   => ['bat' => 'baz'],
            Arg::DATA   => ['dir' => 'asc'],
        ]);

        $this->assertEquals($request->params() + $request->args() + $request->data(), $request->vars());
    }
}
