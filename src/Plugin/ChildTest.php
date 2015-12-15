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
    public function test_construct()
    {
        $this->assertInstanceOf(Child::class, new Child('foo', 'bar'));
    }
}
