<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\Invoke;
use Mvc5\Plugin\Plugin;
use Mvc5\Plugin\Value;
use Mvc5\Test\Test\TestCase;

class InvokeTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $invoke = new Invoke('foo', ['bar']);

        $this->assertEquals('foo', $invoke->config());
        $this->assertEquals(['bar'], $invoke->args());
    }

    /**
     *
     */
    function test_merge()
    {
        $app = new App;

        $invoke = new Invoke(fn($foo, $bar, $baz) => $foo . $bar . $baz, ['s']);

        $callable = $app->plugin($invoke);

        $this->assertEquals('foobars', $callable('foo', 'bar'));
        $this->assertEquals('foobars', $app->call($callable, ['foo', 'bar']));
    }

    /**
     *
     */
    function test_named()
    {
        $app = new App;

        $invoke = new Invoke(fn($foo, $bar, $baz) => $foo . $bar . $baz, ['baz' => 's']);

        $callable = $app->plugin($invoke);

        $this->assertEquals('foobars', $app->call($callable, ['bar' => 'bar', 'foo' => 'foo']));
    }

    /**
     *
     */
    function test_not_named()
    {
        $app = new App;

        $invoke = new Invoke(fn($foo, $bar, $baz) => $foo . $bar . $baz, ['s']);

        $callable = $app->plugin($invoke);

        $this->assertEquals('foobars', $callable('foo', 'bar'));
        $this->assertEquals('foobars', $app->call($callable, ['foo', 'bar']));
    }

    /**
     * @throws \Throwable
     */
    function test_resolve()
    {
        $app = new App;

        $invoke = new Invoke(fn($foo, $bar, $baz) => new Value($foo . $bar . $baz), ['s']);

        $callable = $app->plugin($invoke);

        $this->assertEquals('foobars', $callable('foo', 'bar'));
        $this->assertEquals('foobars', $app->call($callable, ['foo', 'bar']));
    }

    /**
     * @throws \Throwable
     */
    function test_resolve_with_scope()
    {
        if (!($level = ini_get('xdebug.max_nesting_level'))) {
            $this->markTestSkipped('Skipping invoke plugin resolve with scope.');
            return;
        }

        $app = new App([
            'services' => [
                'foo' => new Invoke(new Plugin('foo'))
            ]
        ], null, true);

        $callable = $app->plugin('foo');

        try {

            $callable();

        } catch(\Throwable $exception) {
            $this->assertEquals(
                "Maximum function nesting level of '" . $level . "' reached, aborting!", $exception->getMessage()
            );
        }
    }

    /**
     * @throws \Throwable
     */
    function test_resolve_without_scope()
    {
        if (!($level = ini_get('xdebug.max_nesting_level'))) {
            $this->markTestSkipped('Skipping invoke plugin resolve without scope.');
            return;
        }

        $app = new App([
            'services' => [
                'foo' => new Invoke(new Plugin('foo'))
            ]
        ]);

        $callable = $app->plugin('foo');

        try {

            $callable();

        } catch(\Throwable $exception) {
            $this->assertEquals(
                "Maximum function nesting level of '" . $level . "' reached, aborting!", $exception->getMessage()
            );
        }
    }
}
