<?php

namespace Mvc5\Test\Service\Config\Child;

use Mvc5\Service\Config\Child\Base;
use Mvc5\Test\Test\TestCase;

class BaseTest
    extends TestCase
{
    /**
     *
     */
    public function test_parent()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['parent']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->parent());
    }
}
