<?php

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Child;
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
