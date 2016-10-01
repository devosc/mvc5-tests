<?php
/**
 *
 */

namespace Mvc5\Test\Response\Send;

use Mvc5\Response\Config as Response;
use Mvc5\Response\Emitter\Callback;
use Mvc5\Test\Test\TestCase;

class SendTest
    extends TestCase
{
    /**
     * @return Response
     */
    protected function response()
    {
        return new Response(null, 200, [
            'Content-Type' => 'text\html'
        ], [
            'cookies' => [
                'foo' => [
                    'name'     => 'foo',
                    'value'    => 'bar',
                    'expire'   => 0,
                    'path'     => '',
                    'domain'   => '',
                    'secure'   => false,
                    'httponly' => false
                ]
            ]
        ]);
    }

    /**
     *
     */
    function test_body()
    {
        $send = new Send;

        $send->body(new Response('Hello!'));

        $this->assertEquals('Hello!', $this->getActualOutput());
    }

    /**
     *
     */
    function test_emit()
    {
        $send = new Send;

        $send->body(new Response(new Callback(function () { echo 'Hello!'; })));

        $this->assertEquals('Hello!', $this->getActualOutput());
    }

    /**
     *
     */
    function test_emit_print()
    {
        $send = new Send;

        $send->body(new Response('Hello!'));

        $this->assertEquals('Hello!', $this->getActualOutput());
    }

    /**
     *
     */
    function test_headers_sent()
    {
        $send = new Send;

        $this->assertTrue(headers_sent());

        $send->headers(new Response);
    }

    /**
     * @runInSeparateProcess
     */
    function test_headers_send()
    {
        $send = new Send;

        $send->headers($this->response());
    }

    /**
     * @runInSeparateProcess
     */
    function test_send()
    {
        $send = new Send;

        $this->assertEquals($this->response(), $send->send($this->response()));
    }

    /**
     * @runInSeparateProcess
     */
    function test_invoke()
    {
        $send = new Send;

        $this->assertEquals($this->response(), $send($this->response()));
    }
}
