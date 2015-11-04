<?php

namespace Mvc5\Test\Service\Config\Hydrator;

use Mvc5\Service\Config\Hydrator\Base;
use Mvc5\Test\Test\TestCase;

class BaseTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['__construct'], ['foo', []]);

        $this->assertInternalType('object', $mock);
    }
}
