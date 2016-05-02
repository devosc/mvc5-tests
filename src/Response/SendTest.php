<?php
/**
 *
 */

namespace Mvc5\Test\Response;

use Mvc5\Response\Send;
use Mvc5\Test\Test\TestCase;

class SendTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $send = new Send;

        $this->assertNull($send(new Response));
    }
}
