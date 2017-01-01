<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Config;
use Mvc5\Test\Test\TestCase;

class ConfigTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $this->assertInstanceOf(Config::class, new Config);
    }
}
