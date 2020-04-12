<?php
/**
 *
 */

namespace Mvc5\Test\Config;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Test\Test\TestCase;

use const Mvc5\SERVICES;

final class ScopeTest
    extends TestCase
{
    /**
     * @throws \Throwable
     */
    function test_scope_not_an_object()
    {
        $app = new App([SERVICES => ['foo' => fn() => $this]], null, true);

        $config = new Config($app);
        $clone = clone $config;

        $this->assertSame($app, $config['foo']);
        $this->assertInstanceOf(App::class, $clone['foo']);
        $this->assertNotSame($app, $clone['foo']);
    }
}
