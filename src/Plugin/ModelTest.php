<?php

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Model;
use Mvc5\Test\Test\TestCase;

class ModelTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $this->assertInstanceOf(Model::class, new Model('foo'));
    }
}
