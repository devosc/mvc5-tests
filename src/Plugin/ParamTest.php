<?php

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Param;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ParamTest
    extends TestCase
{
    /**
     *
     */
    public function test_name()
    {
        /** @var Param|Mock $mock */

        $mock = $this->getCleanMock(Param::class, ['name'], ['foo']);

        $this->assertEquals('foo', $mock->name());
    }
}
