<?php

namespace Mvc5\Test\Controller\Dispatch;

use Mvc5\Test\Test\TestCase;

class DispatchTest
    extends TestCase
{
    /**
     *
     */
    public function test_args()
    {
        $mock = $this->getCleanMock(ArgsDispatch::class, ['args'], [function() {}]);

        $this->assertTrue(is_array($mock->args()));
    }
}
