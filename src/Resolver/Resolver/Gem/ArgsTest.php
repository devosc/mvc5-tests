<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Plugin\Args;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Test\TestCase;

class ArgsTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $this->assertEquals(['foo' => new Config], (new App)->plugin(new Args(['foo' => new Plugin(Config::class)])));
    }
}
