<?php

namespace Mvc5\Test\Service\Resolver\Event;

use Mvc5\Service\Resolver\Event\Dispatch;
use Mvc5\Test\Test\TestCase;

class DispatchTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $this->assertInstanceOf(Dispatch::class, new Dispatch('foo'));
    }

    /**
     *
     */
    public function test_args()
    {
        $mock = $this->getCleanMock(ArgsDispatch::class, ['args']);

        $this->assertTrue(is_array($mock->args()));
    }
}
