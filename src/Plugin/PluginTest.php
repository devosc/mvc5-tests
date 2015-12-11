<?php

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Plugin;
use Mvc5\Test\Test\TestCase;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $mock = $this->getCleanMock(Plugin::class, ['__construct'], ['foo']);

        $this->assertInternalType('object', $mock);
    }
}
