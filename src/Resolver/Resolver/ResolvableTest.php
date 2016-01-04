<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\App;
use Mvc5\Arg;
use Mvc5\Plugin\Args;
use Mvc5\Plugin\Call;
use Mvc5\Plugin\Calls;
use Mvc5\Plugin\Child;
use Mvc5\Plugin\Config;
use Mvc5\Plugin\Dependency;
use Mvc5\Plugin\Factory;
use Mvc5\Plugin\Filter;
use Mvc5\Plugin\Invoke;
use Mvc5\Plugin\Invokable;
use Mvc5\Plugin\Link;
use Mvc5\Plugin\Plug;
use Mvc5\Plugin\Plugin;
use Mvc5\Plugin\Param;
use Mvc5\Resolvable;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ResolvableTest
    extends TestCase
{
    /**
     *
     */
    public function atest_resolvable()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $this->assertEquals(false, $mock->resolvableTest(false));
    }

    /**
     *
     */
    public function atest_resolvable_service_factory()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('child');

        $mock->expects($this->once())
            ->method('invoke')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest(new Factory('foo')));
    }

    /**
     *
     */
    public function atest_resolvable_service_calls()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('hydrate')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest(new Calls('foo', [])));
    }

    /**
     *
     */
    public function atest_resolvable_child_service()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('child')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest(new Child('foo', 'bar')));
    }

    /**
     *
     */
    public function atest_resolvable_config()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('provide')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest(new Plugin(null)));
    }

    /**
     *
     */
    public function atest_resolvable_dependency_shared()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('shared')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest(new Dependency('foo')));
    }

    /**
     *
     */
    public function atest_resolvable_dependency_create()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('shared')
            ->willReturn(null);

        $mock->expects($this->once())
            ->method('initialize')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest(new Dependency('foo')));
    }

    /**
     *
     */
    public function atest_resolvable_service_param()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('param');

        $mock->expects($this->once())
             ->method('resolve')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest(new Param('foo')));
    }

    /**
     *
     */
    public function atest_resolvable_service_call()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('call')
            ->willReturn('foo');

        $mock->expects($this->once())
            ->method('args')
            ->willReturn([]);

        $this->assertEquals('foo', $mock->resolvableTest(new Call('foo')));
    }

    /**
     *
     */
    public function atest_resolvable_args()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('args')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest(new Args('foo')));
    }

    /**
     *
     */
    public function atest_resolvable_config_link()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('config')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest(new Config()));
    }

    /**
     *
     */
    public function atest_resolvable_link()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $this->assertEquals($mock, $mock->resolvableTest(new Link()));
    }

    /**
     *
     */
    public function atest_resolvable_filter()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
             ->method('filterable')
             ->willReturn('foo');

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $this->assertEquals('foo', $mock->resolvableTest(new Filter('foo')));
    }

    /**
     *
     */
    public function atest_resolvable_filter_named_param()
    {
        $app = new App([
            Arg::SERVICES => [
                'bar' => function() {
                    return 'bar';
                }
            ]
        ]);

        $filters = [
            function($foo, $o) {
                return $foo . $o;
            },

            new class() {
                function __invoke($foo)
                {
                    return $foo;
                }
            },

            Model\Filterable::class,

            function($foo, $baz, $bar) {
                return $foo . $bar . $baz;
            }
        ];

        $plugin = new Filter('fo', $filters, ['o' => 'o'], 'foo');

        $this->assertEquals('foobars', $app->plugin($plugin, ['baz' => 's']));
    }

    /**
     *
     */
    public function atest_resolvable_filter_merge_param()
    {
        $app = new App([
            Arg::SERVICES => [
                'bar' => function() {
                    return 'bar';
                }
            ]
        ]);

        $filters = [
            function($foo) {
                return $foo;
            },

            new class() {
                function __invoke($foo)
                {
                    return $foo;
                }
            },

            new Invoke(Model\Filterable::class),

            function($foo, $baz, $bar) {
                return $foo . $bar . $baz;
            }
        ];

        $plugin = new Filter('foo', $filters, ['bar']);

        $this->assertEquals('foobars', $app->plugin($plugin, ['s']));
    }

    /**
     *
     */
    public function atest_resolvable_filter_resolvable()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $plugin = new Plugin('Mvc5\Config', [[function($foo) { return $foo; }]]);

        $this->assertEquals('foo', $mock->resolvableTest(new Filter('foo', $plugin)));
    }

    /**
     *
     */
    public function atest_resolvable_filter_args_plugin()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $plugin = new Args([function($foo) { return $foo; }]);

        $this->assertEquals('foo', $mock->resolvableTest(new Filter('foo', $plugin)));
    }

    /**
     *
     */
    public function atest_resolvable_plug()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('configured')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest(new Plug('foo')));
    }

    /**
     *
     */
    public function atest_resolvable_invoke_named()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $invoke = new Invoke(function($foo, $bar, $baz) { return $foo . $bar . $baz; }, ['baz' => 's']);

        $callable = $mock->resolvableTest($invoke);

        $this->assertEquals('foobars', $callable('foo', 'bar'));

        $this->assertEquals('foobars', call_user_func($callable, 'foo', 'bar'));

        $this->assertEquals('foobars', call_user_func_array($callable, ['foo', 'bar']));

        $this->assertEquals('foobars', $mock->call($callable, ['foo', 'bar']));

        $this->assertEquals('foobars', $mock->call($callable, ['bar' => 'bar', 'foo' => 'foo']));
    }

    /**
     *
     */
    public function atest_resolvable_invoke_merge()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $invoke = new Invoke(function($foo, $bar, $baz) { return $foo . $bar . $baz; }, ['s']);

        $callable = $mock->resolvableTest($invoke);

        $this->assertEquals('foobars', $callable('foo', 'bar'));

        $this->assertEquals('foobars', call_user_func($callable, 'foo', 'bar'));

        $this->assertEquals('foobars', call_user_func_array($callable, ['foo', 'bar']));

        $this->assertEquals('foobars', $mock->call($callable, ['foo', 'bar']));
    }

    /**
     *
     */
    public function atest_resolvable_invokable_named()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $invokable = new Invokable(
            new Call(new Invoke(function($foo, $bar, $baz) { return $foo . $bar . $baz; })),
            ['baz' => 's']
        );

        $callable = $mock->resolvableTest($invokable);

        $this->assertEquals('foobars', $callable('foo', 'bar'));

        $this->assertEquals('foobars', call_user_func($callable, 'foo', 'bar'));

        $this->assertEquals('foobars', call_user_func_array($callable, ['foo', 'bar']));

        $this->assertEquals('foobars', $mock->call($callable, ['foo', 'bar']));

        $this->assertEquals('foobars', $mock->call($callable, ['bar' => 'bar', 'foo' => 'foo']));
    }

    /**
     *
     */
    public function test_resolvable_invokable_merge()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $invokable = new Invokable(
            new Call(new Invoke(function($foo, $bar, $baz) { return $foo . $bar . $baz; })),
            ['s']
        );

        $callable = $mock->resolvableTest($invokable);

        $this->assertEquals('foobars', $callable('foo', 'bar'));

        $this->assertEquals('foobars', call_user_func($callable, 'foo', 'bar'));

        $this->assertEquals('foobars', call_user_func_array($callable, ['foo', 'bar']));

        $this->assertEquals('foobars', $mock->call($callable, ['foo', 'bar']));
    }

    /**
     *
     */
    public function atest_resolvable_callback()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $resolvable = $this->getCleanMock(Resolvable::class);

        $this->assertEquals('foo', $mock->resolvableTest($resolvable, [], function() { return 'foo'; }));
    }

    /**
     *
     */
    public function atest_resolvable_resolver()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $resolvable = $this->getCleanMock(Resolvable::class);

        $mock->expects($this->once())
             ->method('resolver')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest($resolvable));
    }
}
