<?php
/**
 *
 */

namespace Mvc5\Test\Response;

use Mvc5\Response\Status;
use Mvc5\Test\Test\TestCase;

class StatusTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $this->assertInstanceOf(Status::class, new Status(null));
    }

    /**
     *
     */
    public function test_invoke()
    {
        $status = new Status('200');

        $this->assertInstanceOf(Response::class, $status(new Response));
    }
}
