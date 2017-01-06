<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App as _App;
use Mvc5\Plugin\App;
use Mvc5\Plugin\Link;
use Mvc5\Test\Test\TestCase;

class AppTest
    extends TestCase
{
    /**
     *
     */
    function test_with_provider()
    {
        $plugin = new App(['foo']);

        $this->assertEquals(_App::class,               $plugin->name());
        $this->assertEquals([['foo'], new Link, true], $plugin->args());
        $this->assertEquals([],                        $plugin->calls());
    }

    /**
     *
     */
    function test_without_provider()
    {
        $plugin = new App(['foo'], null, false, ['bar']);

        $this->assertEquals(_App::class,            $plugin->name());
        $this->assertEquals([['foo'], null, false], $plugin->args());
        $this->assertEquals(['bar'],                $plugin->calls());
    }
}
