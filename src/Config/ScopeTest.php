<?php
/**
 *
 */

namespace Mvc5\Test\Config;

use Mvc5\App;
use Mvc5\Arg;
use Mvc5\Config;
use Mvc5\Test\Test\TestCase;

class ScopeTest
    extends TestCase
{
    /**
     * @throws \Throwable
     */
    function test_scope_not_an_object()
    {
        $app = new App([Arg::SERVICES => ['foo' => fn() => $this]], null, true);

        $config = new Config($app);
        $clone = clone $config;

        $this->assertSame($app, $config['foo']);
        $this->assertInstanceOf(App::class, $clone['foo']);
        $this->assertNotSame($app, $clone['foo']);
    }
}
