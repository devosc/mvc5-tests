<?php
/**
 *
 */

namespace Mvc5\Test\Response\Send;

use Mvc5\Response\Config as Response;
use Mvc5\Response\Emitter\Callback;
use Mvc5\Response\Send;
use Mvc5\Test\Test\TestCase;

class SendTest
    extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    function test_emitter()
    {
        $send = new Send;

        $send(new Response(new Callback(function () { echo 'Hello!'; })));

        $this->assertEquals('Hello!', $this->getActualOutput());
    }

    /**
     * @runInSeparateProcess
     */
    function test_closure()
    {
        $send = new Send;

        $send(new Response(function () { echo 'Hello!'; }));

        $this->assertEquals('Hello!', $this->getActualOutput());
    }

    /**
     * @runInSeparateProcess
     */
    function test_string()
    {
        $send = new Send;

        $send(new Response('Hello!'));

        $this->assertEquals('Hello!', $this->getActualOutput());
    }

    /**
     *
     */
    function test_headers_sent()
    {
        $send = new Send;

        $send(new Response);

        $this->assertEmpty($this->getActualOutput());
    }

    /**
     * @runInSeparateProcess
     */
    function test_with_cookie()
    {
        $send = new Send;

        $response = new Response(null, 200, [
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

        $this->assertEquals($response, $send($response));
    }
}
