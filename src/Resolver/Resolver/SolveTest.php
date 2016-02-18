<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Plugin\Args;
use Mvc5\Plugin\Call;
use Mvc5\Plugin\Calls;
use Mvc5\Plugin\Child;
use Mvc5\Plugin\Config;
use Mvc5\Plugin\Dependency;
use Mvc5\Plugin\Factory;
use Mvc5\Plugin\FileInclude;
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

class SolveTest
    extends TestCase
{
    /**
     *
     */
    public function test_solve()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['solve', 'solveTest']);

        $this->assertEquals(false, $mock->solveTest(false));
    }

    /**
     *
     */
    public function test_solve_factory()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['solve', 'solveTest']);

        $mock->expects($this->once())
            ->method('child');

        $mock->expects($this->once())
            ->method('invoke')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->solveTest(new Factory('foo')));
    }

    /**
     *
     */
    public function test_solve_calls()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['solve', 'solveTest']);

        $mock->expects($this->once())
            ->method('hydrate')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->solveTest(new Calls('foo', [])));
    }

    /**
     *
     */
    public function test_solve_child()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['solve', 'solveTest']);

        $mock->expects($this->once())
            ->method('child')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->solveTest(new Child('foo', 'bar')));
    }

    /**
     *
     */
    public function test_solve_config()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['solve', 'solveTest']);

        $mock->expects($this->once())
            ->method('provide')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->solveTest(new Plugin(null)));
    }

    /**
     *
     */
    public function test_solve_dependency_shared()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['solve', 'solveTest']);

        $mock->expects($this->once())
            ->method('shared')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->solveTest(new Dependency('foo')));
    }

    /**
     *
     */
    public function test_solve_dependency_create()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['solve', 'solveTest']);

        $mock->expects($this->once())
            ->method('shared')
            ->willReturn(null);

        $mock->expects($this->once())
            ->method('initialize')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->solveTest(new Dependency('foo')));
    }

    /**
     *
     */
    public function test_solve_dependency()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $this->assertEquals('test', $mock->solveTest(new Dependency('foo', new Args('test'))));
    }

    /**
     *
     */
    public function test_solve_dependency_not_null()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $value = 0;

        $this->assertTrue(false === $mock->has('foo'));

        $this->assertTrue($value === $mock->solveTest(new Dependency('foo', new Args($value))));

        $this->assertTrue(true === $mock->has('foo'));

        $this->assertTrue(['foo' => $value] === $mock->container());

        $this->assertTrue($value === $mock->solveTest(new Dependency('foo')));
    }

    /**
     *
     */
    public function test_solve_dependency_null()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $this->assertEquals(null, $mock->solveTest(new Dependency('foo', new Args(null))));
    }

    /**
     *
     */
    public function test_solve_param()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['solve', 'solveTest']);

        $mock->expects($this->once())
            ->method('param');

        $mock->expects($this->once())
             ->method('resolve')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->solveTest(new Param('foo')));
    }

    /**
     *
     */
    public function test_solve_call_named()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $call = new Call(Model\CallObject::class, ['foo' => 'foo']);

        $this->assertEquals('foo', $mock->solveTest($call, ['bar' => 'bar']));
    }

    /**
     *
     */
    public function test_solve_call_not_named()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $call = new Call(Model\CallObject::class, ['bar']);

        $this->assertEquals('foo', $mock->solveTest($call, ['foo']));
    }

    /**
     *
     */
    public function test_solve_args()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['solve', 'solveTest']);

        $mock->expects($this->once())
            ->method('args')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->solveTest(new Args('foo')));
    }

    /**
     *
     */
    public function test_solve_config_link()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['solve', 'solveTest']);

        $mock->expects($this->once())
            ->method('config')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->solveTest(new Config()));
    }

    /**
     *
     */
    public function test_solve_link()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['solve', 'solveTest']);

        $this->assertEquals($mock, $mock->solveTest(new Link()));
    }

    /**
     *
     */
    public function test_solve_filter()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['solve', 'solveTest']);

        $mock->expects($this->once())
             ->method('filterable')
             ->willReturn('foo');

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $mock->expects($this->once())
             ->method('arguments')
             ->willReturn([]);

        $this->assertEquals('foo', $mock->solveTest(new Filter('foo')));
    }

    /**
     *
     */
    public function test_solve_plug()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['solve', 'solveTest']);

        $mock->expects($this->once())
            ->method('configured')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->solveTest(new Plug('foo')));
    }

    /**
     *
     */
    public function test_solve_invoke_named()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $invoke = new Invoke(function($foo, $bar, $baz) { return $foo . $bar . $baz; }, ['baz' => 's']);

        $callable = $mock->solveTest($invoke);

        $this->assertEquals('foobars', $callable('foo', 'bar'));

        $this->assertEquals('foobars', call_user_func($callable, 'foo', 'bar'));

        $this->assertEquals('foobars', call_user_func_array($callable, ['foo', 'bar']));

        $this->assertEquals('foobars', $mock->call($callable, ['foo', 'bar']));

        $this->assertEquals('foobars', $mock->call($callable, ['bar' => 'bar', 'foo' => 'foo']));
    }

    /**
     *
     */
    public function test_solve_invoke_merge()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $invoke = new Invoke(function($foo, $bar, $baz) { return $foo . $bar . $baz; }, ['s']);

        $callable = $mock->solveTest($invoke);

        $this->assertEquals('foobars', $callable('foo', 'bar'));

        $this->assertEquals('foobars', call_user_func($callable, 'foo', 'bar'));

        $this->assertEquals('foobars', call_user_func_array($callable, ['foo', 'bar']));

        $this->assertEquals('foobars', $mock->call($callable, ['foo', 'bar']));
    }

    /**
     *
     */
    public function test_solve_invokable_named()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $invokable = new Invokable(
            new Call(new Invoke(function($foo, $bar, $baz) { return $foo . $bar . $baz; })),
            ['baz' => 's']
        );

        $callable = $mock->solveTest($invokable);

        $this->assertEquals('foobars', $callable('foo', 'bar'));

        $this->assertEquals('foobars', call_user_func($callable, 'foo', 'bar'));

        $this->assertEquals('foobars', call_user_func_array($callable, ['foo', 'bar']));

        $this->assertEquals('foobars', $mock->call($callable, ['foo', 'bar']));

        $this->assertEquals('foobars', $mock->call($callable, ['bar' => 'bar', 'foo' => 'foo']));
    }

    /**
     *
     */
    public function test_solve_invokable_merge()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $invokable = new Invokable(
            new Call(new Invoke(function($foo, $bar, $baz) { return $foo . $bar . $baz; })),
            ['s']
        );

        $callable = $mock->solveTest($invokable);

        $this->assertEquals('foobars', $callable('foo', 'bar'));

        $this->assertEquals('foobars', call_user_func($callable, 'foo', 'bar'));

        $this->assertEquals('foobars', call_user_func_array($callable, ['foo', 'bar']));

        $this->assertEquals('foobars', $mock->call($callable, ['foo', 'bar']));
    }

    /**
     *
     */
    public function test_solve_file_include()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $plugin = new FileInclude(__DIR__ . '/Model/config.inc.php');

        $this->assertEquals(['foo' => 'bar'], $mock->solveTest($plugin));
    }

    /**
     *
     */
    public function test_solve_callback()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['solve', 'solveTest']);

        $resolvable = $this->getCleanMock(Resolvable::class);

        $this->assertEquals('foo', $mock->solveTest($resolvable, [], function() { return 'foo'; }));
    }

    /**
     *
     */
    public function test_solve_resolver()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['solve', 'solveTest']);

        $resolvable = $this->getCleanMock(Resolvable::class);

        $mock->expects($this->once())
             ->method('resolver')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->solveTest($resolvable));
    }
}
