<?php
/**
 *
 */

namespace Mvc5\Test\Plugin\Config;

use Mvc5\Plugin\Args as Config;
use Mvc5\Test\Test\TestCase;

class ConfigTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $this->assertInstanceOf(Config::class, new Config(null));
    }

    /**
     *
     */
    function test_config()
    {
        $config = new Config('foo');

        $this->assertEquals('foo', $config->config());
    }
}
