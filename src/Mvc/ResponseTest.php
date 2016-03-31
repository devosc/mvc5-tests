<?php
/**
 *
 */

namespace Mvc5\Test\Mvc;

use Mvc5\Mvc\Response;
use Mvc5\Test\Response\Response as TestResponse;
use Mvc5\Test\Test\TestCase;

class ResponseTest
    extends TestCase
{
    /**
     *
     */
    public function test_invoke()
    {
        $response = new Response;

        $this->assertInstanceOf(TestResponse::class, $response(new TestResponse));
    }
}
