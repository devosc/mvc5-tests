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
    public function test__construct()
    {
        $mock = $this->getCleanMock(Model::class, ['__construct'], ['foo']);

        $this->assertInternalType('object', $mock);
    }
}
