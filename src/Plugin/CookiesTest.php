<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Arg;
use Mvc5\Plugin\Cookies;
use Mvc5\Test\Test\TestCase;
use Mvc5\Cookie\Config;
use Mvc5\Cookie\Sender;

class CookiesTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $plugin = new Cookies;

        $this->assertEquals(Arg::COOKIES, $plugin->name());
        $this->assertEquals([Config::class, new Sender, $_COOKIE], $plugin->config());
    }
}
