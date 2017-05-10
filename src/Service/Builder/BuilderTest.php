<?php
/**
 *
 */

namespace Mvc5\Test\Service\Builder;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Model;
use Mvc5\Service\Builder;
use Mvc5\Route\Dispatch;
use Mvc5\Route\Match\Path;
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
            Autowire::class, Builder::create(Autowire::class, ['foo' => 'bar'], new App)
        );
    }

    /**
     *
     */
    function test_callback_param()
    {
        $app = new App([
            'services' => [
                'foo' => Config::class
            ]
        ]);

        $this->assertInstanceOf(
            Autowire::class, Builder::create(Autowire::class, ['model' => new Model], $app)
        );
    }

    /**
     *
     */
    function test_missing_param()
    {
        $this->expectExceptionMessage('Missing required parameter $match for ' . Dispatch::class);

        Builder::create(Dispatch::class, [], new App);
    }

    /**
     *
     */
    function test_named_args()
    {
        $this->assertInstanceOf(
            Autowire::class, Builder::create(Autowire::class, ['model' => new Model, 'foo' => 'bar'], new App)
        );
    }

    /**
     *
     */
    function test_null_arg()
    {
        $class = Builder::create(Autowire::class, ['model' => new Model, 'foo' => null], new App);

        $this->assertInstanceOf(Autowire::class, $class);
        $this->assertNull($class->foo);
    }

    /**
     *
     */
    function test_named_args_no_constructor()
    {
        $class = NoConstructorArgs::class;

        $this->assertInstanceOf(
            $class, Builder::create($class, ['model' => new Model, 'foo' => 'bar'], new App)
        );
    }

    /**
     *
     */
    function test_not_named_args()
    {
        $this->assertInstanceOf(
            Autowire::class, Builder::create(Autowire::class, [new Model, 'foo'], new App)
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

    /**
     *
     */
    function test_without_constructor()
    {
        $this->assertInstanceOf(
            Path::class, Builder::create(Path::class, [], new App)
        );
    }
}
