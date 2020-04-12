<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\Call;
use Mvc5\Plugin\Expect;
use Mvc5\Plugin\Plugin;
use Mvc5\Plugin\Value;
use Mvc5\Test\Test\TestCase;

final class ExpectTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $expect = new Expect('foo');

        $this->assertEquals(new Value('foo'), $expect->plugin());
        $this->assertEquals(new Value(null), $expect->exception());
    }

    /**
     *
     */
    function test_resolvable()
    {
        $expect = new Expect(new Plugin('foo'), new Plugin('bar'));

        $this->assertEquals(new Plugin('foo'), $expect->plugin());
        $this->assertEquals(new Plugin('bar'), $expect->exception());
    }

    /**
     *
     */
    function test_exception()
    {
        (new App)(new Expect(
            new Call('@Mvc5\Exception::runtime', ['test']),
            new Call(fn(\Throwable $e) => $this->assertEquals('test', $e->getMessage()))
        ));
    }

    /**
     *
     */
    function test_exception_as_named_arg()
    {
        $result = (new App)(new Expect(
            new Call(function() { throw new \Exception('foo'); }),
            new Call(fn(\Throwable $exception) => $exception->getMessage()),
            true
        ));

        $this->assertEquals('foo', $result);
    }

    /**
     *
     */
    function test_exception_with_named_args()
    {
        $result = (new App)(new Expect(
            new Call(function() { throw new \Exception('foo'); }),
            new Call(fn(\Throwable $exception, $argv) => $exception->getMessage() . $argv['bar']),
            true,
            true
        ), ['bar' => 'bar']);

        $this->assertEquals('foobar', $result);
    }

    /**
     *
     */
    function test_named_args()
    {
        $result = (new App)(new Expect(
            new Call(fn($b, $a) => $a . $b, ['b' => new Value('bar')])
        ), ['a' => 'foo']);

        $this->assertEquals('foobar', $result);
    }

    /**
     *
     */
    function test_not_named_args()
    {
        $result = (new App)(new Expect(new Call(fn($a, $b) => $a . $b, ['bar'])), ['foo']);

        $this->assertEquals('foobar', $result);
    }
}
