<?php

namespace Mvc5\Test\Service\Config\Service;

use Mvc5\Service\Config\Service\Service;
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
