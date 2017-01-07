<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Builder;

use Mvc5\Arg;
use Mvc5\Config;
use Mvc5\Resolver\Builder;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Resolver\Resolver\Model\Autowire;
use Mvc5\Test\Resolver\Resolver\Model\AutowireMissingParam;
use Mvc5\Test\Resolver\Resolver\Model\AutowireNoConstructor;
use Mvc5\Test\Resolver\Resolver\Model\AutowireNoConstructorArgs;
use Mvc5\Test\Resolver\Resolver\Model\CallEvent;
use Mvc5\Test\Test\TestCase;

class BuilderTest
    extends TestCase
{
    /**
     *
     */
    function test_auto_wire()
    {
        $this->assertInstanceOf(
            Autowire::class, Builder::create(Autowire::class, ['foo' => 'bar'], new Resolver)
        );
    }

    /**
     *
     */
    function test_without_constructor()
    {
        $this->assertInstanceOf(
            AutowireNoConstructor::class, Builder::create(AutowireNoConstructor::class, [], new Resolver)
        );
    }

    /**
     *
     */
    function test_not_named_args()
    {
        $this->assertInstanceOf(
            Autowire::class, Builder::create(Autowire::class, [new CallEvent, 'foo'], new Resolver)
        );
    }

    /**
     *
     */
    function test_named_args()
    {
        $this->assertInstanceOf(
            Autowire::class, Builder::create(Autowire::class, ['event' => new CallEvent, 'foo' => 'bar'], new Resolver)
        );
    }

    /**
     *
     */
    function test_named_args_no_constructor()
    {
        $class = AutowireNoConstructorArgs::class;

        $this->assertInstanceOf(
            $class, Builder::create($class, ['event' => new CallEvent, 'foo' => 'bar'], new Resolver)
        );
    }

    /**
     *
     */
    function test_callback_param()
    {
        $resolver = new Resolver;

        $resolver->configure('foo', Config::class);

        $this->assertInstanceOf(
            Autowire::class, Builder::create(Autowire::class, [Arg::EVENT => new CallEvent], $resolver)
        );
    }

    /**
     *
     */
    function test_missing_param()
    {
        $this->setExpectedException(
            'RuntimeException', 'Missing required parameter $foo for ' . AutowireMissingParam::class
        );

        $this->assertInstanceOf(
            AutowireMissingParam::class, Builder::create(AutowireMissingParam::class, [], new Resolver)
        );
    }

    /**
     *
     */
    function test_reflection_class()
    {
        $reflection1 = Builder::reflectionClass(self::class);
        $reflection2 = Builder::reflectionClass(self::class);

        $this->assertTrue($reflection1 === $reflection2);
    }
}
