<?php
/**
 *
 */

namespace Mvc5\Test\Request\Exception;

use Mvc5\App;
use Mvc5\Http\HttpRequest;
use Mvc5\Request\Exception\Controller;
use Mvc5\Request\Exception\ExceptionLayout;
use Mvc5\Request\Exception\ViewLayout;
use Mvc5\Response\JsonExceptionResponse;
use Mvc5\Test\Test\TestCase;

use const Mvc5\{ EXCEPTION_LAYOUT, RESPONSE_JSON_EXCEPTION };

/**
 *
 */
final class ControllerTest
    extends TestCase
{
    /**
     * @throws \Throwable
     */
    function test_json_exception_response()
    {
        $config = ['services' => [RESPONSE_JSON_EXCEPTION => JsonExceptionResponse::class]];

        $request = new HttpRequest(['accepts_json' => true, 'exception' => new \Exception('foo')]);

        $response = (new Controller(new App($config)))($request);

        $this->assertEquals(500, $response->status());
        $this->assertEquals('', json_decode($response->body())->message);
    }

    /**
     * @throws \Throwable
     */
    function test_json_exception_with_trace_response()
    {
        $config = ['services' => [RESPONSE_JSON_EXCEPTION => [JsonExceptionResponse::class, 'trace' => true]]];

        $request = new HttpRequest(['accepts_json' => true, 'exception' => new \Exception('foo')]);

        $response = (new Controller(new App($config)))($request);
        $result = json_decode($response->body());

        $this->assertEquals(500, $response->status());
        $this->assertEquals(0, $result->code);
        $this->assertEquals('foo', $result->message);
        $this->assertEquals(46, $result->line);
        $this->assertEquals(__FILE__, $result->file);
        $this->assertIsArray($result->trace);
    }

    /**
     * @throws \Throwable
     */
    function test_view_exception_layout()
    {
        $config = ['services' => [EXCEPTION_LAYOUT => [ViewLayout::class, 'template' => 'exception']]];

        $request = new HttpRequest(['exception' => new \Exception('Foobar')]);

        $layout = (new Controller(new App($config)))($request);

        $this->assertInstanceOf(ExceptionLayout::class, $layout);
    }
}
