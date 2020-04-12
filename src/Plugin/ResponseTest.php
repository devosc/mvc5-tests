<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Plugin;
use Mvc5\Plugin\Response;
use Mvc5\Test\Test\TestCase;

final class ResponseTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $response = new Response('foo');

        $args = ['event' => 'foo', 'request' => new Plugin('request'), 'response' => new Plugin('response')];

        $this->assertEquals('response\dispatch', $response->name());
        $this->assertEquals($args, $response->args());
        $this->assertEquals('item', $response->param());
        $this->assertFalse($response->merge());
    }
}
