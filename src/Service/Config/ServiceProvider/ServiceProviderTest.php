<?php

namespace Mvc5\Test\Service\Config\ServiceProvider;

use Mvc5\Service\Config\ServiceProvider\ServiceProvider;
use Mvc5\Test\Test\TestCase;

class ServiceProviderTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $mock = $this->getCleanMock(ServiceProvider::class, ['__construct'], ['foo']);

        $this->assertInternalType('object', $mock);
    }
}
