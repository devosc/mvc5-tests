<?php

namespace Mvc5\Test\View\Exception;

use Mvc5\View\Exception\Model;
use Mvc5\Test\Test\TestCase;

class ModelTest
    extends TestCase
{
    /**
     *
     */
    public function test_exception()
    {
        $mock = $this->getCleanMock(Model::class, ['exception']);

        $exception = $this->getCleanMock(\Exception::class);

        $mock->expects($this->once())
             ->method('set');

        $this->assertTrue(null === $mock->exception($exception));
    }
}
