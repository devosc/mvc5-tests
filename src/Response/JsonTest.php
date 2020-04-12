<?php
/**
 *
 */

namespace Mvc5\Test\Response;

use Mvc5\Http\HttpHeaders;
use Mvc5\Response\JsonResponse;
use Mvc5\Test\Test\TestCase;

use const Mvc5\{ BODY, HTTP_OK };

final class JsonTest
    extends TestCase
{
    /**
     * @throws \Throwable
     */
    function test()
    {
        $data = ['PHP' => phpversion(), 'System' => php_uname()];

        $response = new JsonResponse($data);

        $this->assertEquals((object) $data, json_decode($response[BODY]));
        $this->assertEquals(HTTP_OK, $response->status());
        $this->assertEquals(new HttpHeaders(['Content-Type' => 'application/json']), $response->headers());
    }
}
