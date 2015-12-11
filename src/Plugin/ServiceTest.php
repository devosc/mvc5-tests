<?php

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Service;
use Mvc5\Test\Test\TestCase;

class ServiceTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $mock = $this->getCleanMock(Service::class, ['__construct'], ['foo']);

        $this->assertInternalType('object', $mock);
    }
}
