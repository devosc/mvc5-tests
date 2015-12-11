<?php

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Mvc;
use Mvc5\Test\Test\TestCase;

class MvcTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $mock = $this->getCleanMock(Mvc::class, ['__construct'], ['foo']);

        $this->assertInternalType('object', $mock);
    }
}
