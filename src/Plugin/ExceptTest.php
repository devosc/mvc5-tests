<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\Call;
use Mvc5\Plugin\Expect;
use Mvc5\Plugin\Value;
use Mvc5\Test\Test\TestCase;

class ExceptTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $expect = new Expect('foo');

        $this->assertEquals('foo', $expect->plugin());
        $this->assertNull($expect->exception());
    }

    /**
     *
     */
    function test_exception()
    {
        (new App)(new Expect(
            new Call('@Mvc5\Exception::runtime', ['test']),
            new Call(function(\Throwable $e) {
                $this->assertEquals('test', $e->getMessage());
            })
        ));
    }

    /**
     *
     */
    function test_exception_as_named_arg()
    {
        $result = (new App)(new Expect(
            new Call(function() { throw new \Exception('foo'); }),
            new Call(function(\Throwable $exception) { return $exception->getMessage(); }),
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
            new Call(function(\Throwable $exception, $argv) { return $exception->getMessage() . $argv['bar']; }),
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
            new Call(function($b, $a) { return $a . $b; }, ['b' => new Value('bar')])
        ), ['a' => 'foo']);

        $this->assertEquals('foobar', $result);
    }

    /**
     *
     */
    function test_not_named_args()
    {
        $result = (new App)(new Expect(new Call(function($a, $b) { return $a . $b; }, ['bar'])), ['foo']);

        $this->assertEquals('foobar', $result);
    }
}
