<?php
/**
 *
 */

namespace Mvc5\Test\Response;

use Mvc5\Response\Config as Response;
use Mvc5\Response\Send;
use Mvc5\Test\Test\TestCase;

class SendTest
    extends TestCase
{
    /**
     *
     */
    function test_send_headers_sent()
    {
        $send = new Send;

        $this->assertNull($send(new Response));
    }

    /**
     * @runInSeparateProcess
     */
    function test_send_http_response()
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

        $this->assertNull($send($response));
    }
}
