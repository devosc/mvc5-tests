<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Build;

use Mvc5\Arg;
use Mvc5\Config;
use Mvc5\Test\Resolver\Resolver\Model\Autowire;
use Mvc5\Test\Resolver\Resolver\Model\AutowireMissingParam;
use Mvc5\Test\Resolver\Resolver\Model\AutowireNoConstructor;
use Mvc5\Test\Resolver\Resolver\Model\AutowireNoConstructorArgs;
use Mvc5\Test\Resolver\Resolver\Model\CallEvent;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class MakeTest
    extends TestCase
{
    /**
     *
     */
    public function test_make()
    {
        $resolver = new Resolver;

        $this->assertInstanceOf(Autowire::class, $resolver->make(Autowire::class, ['foo' => 'bar']));
    }

    /**
     *
     */
    public function test_make_without_constructor()
    {
        $resolver = new Resolver;

        $this->assertInstanceOf(AutowireNoConstructor::class, $resolver->make(AutowireNoConstructor::class));
    }

    /**
     *
     */
    public function test_make_no_named_args()
    {
        $resolver = new Resolver;

        $args = [new CallEvent, 'foo'];

        $this->assertInstanceOf(Autowire::class, $resolver->make(Autowire::class, $args));
    }

    /**
     *
     */
    public function test_make_with_named_args()
    {
        $resolver = new Resolver;

        $args = ['event' => new CallEvent, 'foo' => 'bar'];

        $this->assertInstanceOf(Autowire::class, $resolver->make(Autowire::class, $args));
    }

    /**
     *
     */
    public function test_make_with_named_args_but_no_constructor_args()
    {
        $resolver = new Resolver;

        $args = ['event' => new CallEvent, 'foo' => 'bar'];

        $class = AutowireNoConstructorArgs::class;

        $this->assertInstanceOf($class, $resolver->make($class, $args));
    }

    /**
     *
     */
    public function test_make_with_callback_param()
    {
        $resolver = new Resolver;

        $resolver->configure('foo', Config::class);

        $this->assertInstanceOf(
            Autowire::class, $resolver->make(Autowire::class, [Arg::EVENT => new CallEvent])
        );
    }

    /**
     *
     */
    public function test_make_with_missing_param()
    {
        $resolver = new Resolver;

        $this->setExpectedException('RuntimeException');

        $this->assertInstanceOf(AutowireMissingParam::class, $resolver->make(AutowireMissingParam::class));
    }
}
