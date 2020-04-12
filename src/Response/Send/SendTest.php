<?php
/**
 *
 */

namespace Mvc5\Test\Response\Send;

use Mvc5\Response\Emitter\Callback;
use Mvc5\Response\HttpResponse;
use Mvc5\Response\Send;
use Mvc5\Test\Test\TestCase;

final class SendTest
    extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    function test_closure()
    {
        $send = new Send;

        $send(new HttpResponse(function () { echo 'Hello!'; }));

        $this->assertEquals('Hello!', $this->getActualOutput());
    }

    /**
     * @runInSeparateProcess
     */
    function test_emitter()
    {
        $send = new Send;

        $send(new HttpResponse(new Callback(function () { echo 'Hello!'; })));

        $this->assertEquals('Hello!', $this->getActualOutput());
    }

    /**
     *
     */
    function test_headers_sent()
    {
        $send = new Send;

        $send(new HttpResponse);

        $this->assertEmpty($this->getActualOutput());
    }

    /**
     * @runInSeparateProcess
     */
    function test_string()
    {
        $send = new Send;

        $send(new HttpResponse('Hello!'));

        $this->assertEquals('Hello!', $this->getActualOutput());
    }

    /**
     * @runInSeparateProcess
     */
    function test_with_cookie()
    {
        $send = new Send;

        $response = new HttpResponse(null, 200, [
            'Content-Type' => 'text\html'
        ], [
            'cookies' => [
                'foo' => [
                    'name'     => 'foo',
                    'value'    => 'bar',
                    'expires'   => 0,
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
