<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Config;
use Mvc5\Plugin\Args;
use Mvc5\Plugin\End;
use Mvc5\Plugin\Call;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class EndTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $plugin = new End('foo', 'bar');

        $this->assertEquals([new Args(['foo', 'bar'])], $plugin->args());
    }

    /**
     *
     */
    function test_end()
    {
        $resolver = new Resolver;

        $plugin = new End(new Call('@phpversion'), new Plugin(Config::class, [['foo' => 'bar']]));

        $this->assertEquals(new Config(['foo' => 'bar']), $resolver->gem($plugin));
    }
}
