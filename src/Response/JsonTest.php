<?php
/**
 *
 */

namespace Mvc5\Test\Response;

use Mvc5\Arg;
use Mvc5\Http\HttpHeaders;
use Mvc5\Response\JsonResponse;
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

        $response = new JsonResponse($data);

        $this->assertEquals((object) $data, json_decode($response[Arg::BODY]));
        $this->assertEquals(Arg::HTTP_OK, $response->status());
        $this->assertEquals(new HttpHeaders(['Content-Type' => 'application/json']), $response->headers());
    }
}
