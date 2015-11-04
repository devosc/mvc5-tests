<?php

namespace Mvc5\Test\Service\Config\Child;

use Mvc5\Service\Config\Child\Child;
use Mvc5\Test\Test\TestCase;

class ChildTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $this->assertInstanceOf(Child::class, new Child('foo', 'bar'));
    }
}
