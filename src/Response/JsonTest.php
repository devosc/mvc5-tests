<?php
/**
 *
 */

namespace Mvc5\Test\Response\Config;

use Mvc5\Arg;
use Mvc5\Http\Headers\Config as Headers;
use Mvc5\Response\Json;
use Mvc5\Test\Test\TestCase;

class JsonTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $data = ['PHP' => phpversion(), 'System' => php_uname()];

        $response = new Json($data);

        $this->assertEquals((object) $data, json_decode($response[Arg::BODY]));
        $this->assertEquals(Arg::HTTP_OK, $response->status());
        $this->assertEquals(new Headers(['Content-Type' => 'application/json']), $response->headers());
    }
}
