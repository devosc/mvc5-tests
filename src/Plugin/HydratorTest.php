<?php

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Hydrator;
use Mvc5\Test\Test\TestCase;

class HydratorTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $mock = $this->getCleanMock(Hydrator::class, ['__construct'], ['foo', []]);

        $this->assertInternalType('object', $mock);
    }
}
