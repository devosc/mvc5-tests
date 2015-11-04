<?php

namespace Mvc5\Test\Controller\Exception;

use Mvc5\Test\Test\TestCase;

class ExceptionTest
    extends TestCase
{
    /**
     *
     */
    public function test_args()
    {
        $mock = $this->getCleanMock(ArgsException::class, ['args'], [new \Exception]);

        $this->assertTrue(is_array($mock->args()));
    }
}
