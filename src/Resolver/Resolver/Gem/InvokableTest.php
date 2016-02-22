<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\Call;
use Mvc5\Plugin\Invoke;
use Mvc5\Plugin\Invokable;
use Mvc5\Test\Resolver\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class InvokableTest
    extends TestCase
{
    /**
     *
     */
    public function test_gem_invokable_named()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $invokable = new Invokable(
            new Call(new Invoke(function($foo, $bar, $baz) { return $foo . $bar . $baz; })),
            ['baz' => 's']
        );

        $callable = $mock->gemTest($invokable);

        $this->assertEquals('foobars', $callable('foo', 'bar'));

        $this->assertEquals('foobars', call_user_func($callable, 'foo', 'bar'));

        $this->assertEquals('foobars', call_user_func_array($callable, ['foo', 'bar']));

        $this->assertEquals('foobars', $mock->call($callable, ['foo', 'bar']));

        $this->assertEquals('foobars', $mock->call($callable, ['bar' => 'bar', 'foo' => 'foo']));
    }

    /**
     *
     */
    public function test_gem_invokable_merge()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $invokable = new Invokable(
            new Call(new Invoke(function($foo, $bar, $baz) { return $foo . $bar . $baz; })),
            ['s']
        );

        $callable = $mock->gemTest($invokable);

        $this->assertEquals('foobars', $callable('foo', 'bar'));

        $this->assertEquals('foobars', call_user_func($callable, 'foo', 'bar'));

        $this->assertEquals('foobars', call_user_func_array($callable, ['foo', 'bar']));

        $this->assertEquals('foobars', $mock->call($callable, ['foo', 'bar']));
    }
}
