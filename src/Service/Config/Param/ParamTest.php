<?php

namespace Mvc5\Test\Service\Config\Param;

use Mvc5\Service\Config\Param\Param;
use Mvc5\Test\Test\TestCase;

class ParamTest
    extends TestCase
{
    /**
     *
     */
    public function test_name()
    {
        $mock = $this->getCleanMock(Param::class, ['name'], ['foo']);

        $this->assertEquals('foo', $mock->name());
    }
}
