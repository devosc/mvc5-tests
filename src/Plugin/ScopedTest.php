<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Plugin\Scoped;
use Mvc5\Test\Test\TestCase;

final class ScopedTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $scoped = new Scoped([$this, 'foo']);

        $this->assertInstanceOf(\Closure::class, $scoped->closure());
        $this->assertTrue($scoped->scoped());
    }

    /**
     *
     */
    function test_scoped()
    {
        $app = new App(null, null, true);

        $scoped = $app->plugin(new Scoped([$this, 'foo']));

        $this->assertInstanceOf(\Closure::class, $scoped);
        $this->assertEquals($app, $scoped());
    }

    /**
     *
     */
    function test_scoped_class()
    {
        $config = new Config;
        $app = new App(null, null, $config);

        $scoped = $app->plugin(new Scoped([$this, 'foo']));

        $this->assertInstanceOf(\Closure::class, $scoped);
        $this->assertEquals($config, $scoped());
    }

    /**
     * @return \Closure
     */
    function foo()
    {
        return fn() => $this;
    }
}
