<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Test\TestCase;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $this->assertEquals(
            new Config(['foo' => 'bar']), (new App)->plugin(new Plugin(Config::class, [['foo' => 'bar']]))
        );
    }
}
