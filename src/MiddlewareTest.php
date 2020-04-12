<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Middleware;
use Mvc5\Test\Test\TestCase;

final class MiddlewareTest
    extends TestCase
{
    /**
     *
     */
    function test_empty_stack_with_no_args()
    {
        $this->assertNull((new App)->call(new Middleware(new App)));
    }

    /**
     *
     */
    function test_empty_stack_returns_last_param()
    {
        $this->assertEquals('baz', (new Middleware(new App))('foo', 'bar', 'baz'));
    }

    /**
     *
     */
    function test_array_stack_with_reset()
    {
        $middleware = new Middleware(
            new App,
            [
                function ($value, $next) {
                    return $next($value . 'a');
                },
                function ($value, $next) {
                    return $next($value . 'z');
                }
            ]
        );

        $this->assertEquals('baz', $middleware('b'));
        $this->assertEquals('baz', $middleware('b'));
    }

    /**
     *
     */
    function test_iterator_stack_with_reset()
    {
        $middleware = new Middleware(
            new App,
            new Config([
                function ($value, $next) {
                    return $next($value . 'a');
                },
                function ($value, $next) {
                    return $next($value . 'z');
                }
            ])
        );

        $this->assertEquals('baz', $middleware('b'));
        $this->assertEquals('baz', $middleware('b'));
    }
}
