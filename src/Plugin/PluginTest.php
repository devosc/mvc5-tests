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
    public function test_construct()
    {
        $this->assertInstanceOf(Plugin::class, new Plugin('foo'));
    }
}
