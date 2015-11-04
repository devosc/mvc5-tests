<?php

namespace Mvc5\Test\Service\Resolver;

use Mvc5\Application\App;
use Mvc5\Service\Config\Args\Args;
use Mvc5\Service\Config\Call\Call;
use Mvc5\Service\Config\Calls\Calls;
use Mvc5\Service\Config\Child\Child;
use Mvc5\Service\Config\ConfigLink\ConfigLink;
use Mvc5\Service\Config\Config;
use Mvc5\Service\Config\Dependency\Dependency;
use Mvc5\Service\Config\Factory\Factory;
use Mvc5\Service\Config\Filter\Filter;
use Mvc5\Service\Config\Invokable\Invokable;
use Mvc5\Service\Config\Invoke\Invoke;
use Mvc5\Service\Config\Param\Param;
use Mvc5\Service\Config\ServiceConfig\ServiceConfig;
use Mvc5\Service\Config\ServiceManagerLink\ServiceManagerLink;
use Mvc5\Service\Container\ServiceCollection;
use Mvc5\Service\Resolver\Resolvable;
use Mvc5\Test\Test\TestCase;

class ResolverTest
    extends TestCase
{
    /**
     *
     */
    public function test_args()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['args', 'testArgs']);

        $this->assertEquals(false, $mock->testArgs(false));
    }

    /**
     *
     */
    public function test_args_not_array()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['args', 'testArgs']);

        $mock->expects($this->once())
             ->method('resolve')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->testArgs('foo'));
    }

    /**
     *
     */
    public function test_args_array()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['args', 'testArgs']);

        $mock->expects($this->once())
             ->method('resolve')
             ->willReturn('bar');

        $this->assertEquals(['foo' => 'bar'], $mock->testArgs(['foo' => new ConfigLink]));
    }

    /**
     *
     */
    public function test_build_one_with_callback()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['build', 'testBuild']);

        $this->assertEquals('bar', $mock->testBuild(['foo'], [], function() { return 'bar'; }));
    }

    /**
     *
     */
    public function test_build_one_without_callback()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['build', 'testBuild']);

        $mock->expects($this->once())
             ->method('make')
             ->willReturn('bar');

        $this->assertEquals('bar', $mock->testBuild(['foo']));
    }

    /**
     *
     */
    public function test_build_array()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['build', 'testBuild']);

        $mock->expects($this->once())
             ->method('compose')
             ->willReturn('baz');

        $this->assertEquals('baz', $mock->testBuild(['foo', 'bar']));
    }

    /**
     *
     */
    public function test_call_not_string_event()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['call']);

        $mock->expects($this->once())
             ->method('trigger')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->call(new CallEvent));
    }

    /**
     *
     */
    public function test_call_not_string_invoke()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['call']);

        $mock->expects($this->once())
             ->method('invoke')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->call(new \stdClass));
    }

    /**
     *
     */
    public function test_call_plugin_callable()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['call', 'plugin']);

        $mock->expects($this->once())
             ->method('invoke')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->call('time'));
    }

    /**
     *
     */
    public function test_call_plugin_not_callable()
    {
        $sm = new App([
            'alias'    => [
                'event:create' => function() {
                    return null;
                }
            ],
            'events'   => [],
            'services' => [
                'Service\Container' => []
            ]
        ]);

        $this->setExpectedException('RuntimeException');

        $sm->call('foo');
    }

    /**
     *
     */
    public function test_call_plugin_callable_event()
    {
        $sm = new App([
            'alias'    => [
                'event:create' => function() {
                    return new CallEvent;
                }
            ],
            'events'   => [
                'callable:event' => [
                    function() {
                        return 'bar';
                    }
                ]
            ],
            'services' => [
                'Service\Container' => []
            ]
        ]);

        $this->assertEquals('bar', $sm->call('foo'));
    }

    /**
     *
     */
    public function test_call_event()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['call']);

        $mock->expects($this->once())
             ->method('plugin')
             ->willReturn(new CallEvent);

        $mock->expects($this->once())
             ->method('trigger')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->call('bar'));
    }

    /**
     *
     */
    public function test_call_invoke()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['call']);

        $mock->expects($this->once())
             ->method('plugin');

        $mock->expects($this->any())
             ->method('invoke')
             ->will($this->onConsecutiveCalls('bar', 'foo'));

        $this->assertEquals('foo', $mock->call('bar.baz.foobar'));
    }

    /**
     *
     */
    public function test_child()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['child', 'testChild']);

        $mock->expects($this->once())
             ->method('configured')
             ->willReturn(new Config);

        $mock->expects($this->once())
             ->method('merge')
             ->will($this->returnArgument(0));

        $mock->expects($this->once())
             ->method('provide')
             ->willReturn('baz');

        $this->assertEquals('baz', $mock->testChild(new Child('foo', 'bar')));
    }

    /**
     *
     */
    public function test_compose_service_manager()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['compose', 'testCompose']);

        $app = $this->getCleanMock(App::class);

        $app->expects($this->once())
            ->method('create')
            ->willReturn('bar');

        $this->assertEquals('bar', $mock->testCompose($app, ['foo']));
    }

    /**
     *
     */
    public function test_compose_container()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['compose', 'testCompose']);

        $container = $this->getCleanMock(ServiceCollection::class);

        $container->expects($this->once())
                  ->method('offsetGet')
                  ->willReturn('bar');

        $mock->expects($this->once())
            ->method('create')
            ->willReturn('baz');

        $this->assertEquals('baz', $mock->testCompose($container, ['foo']));
    }

    /**
     *
     */
    public function test_compose_array()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['compose', 'testCompose']);

        $mock->expects($this->once())
            ->method('resolve')
            ->willReturn('baz');

        $this->assertEquals('baz', $mock->testCompose(['foo' => 'bar'], ['foo']));
    }

    /**
     *
     */
    public function test_filter()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['filter', 'testFilter']);

        $this->assertEquals('foo', $mock->testFilter(null, [function() { return 'foo'; }]));
    }

    /**
     *
     */
    public function test_hydrate()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['hydrate', 'testHydrate']);

        $this->assertEquals('foo', $mock->testHydrate(new Config, 'foo'));
    }

    /**
     *
     */
    public function test_hydrate_array()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['hydrate', 'testHydrate']);

        $mock->expects($this->once())
             ->method('invoke');

        $config = $this->getCleanMock(Config::class);

        $config->expects($this->once())
               ->method('calls')
               ->willReturn([['set', 'bar']]);

        $service = $this->getCleanMock(Config::class);

        $this->assertInstanceOf(Config::class, $mock->testHydrate($config, $service));
    }

    /**
     *
     */
    public function test_hydrate_array_args()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['hydrate', 'testHydrate']);

        $mock->expects($this->once())
             ->method('invoke');

        $config = $this->getCleanMock(Config::class);

        $config->expects($this->once())
               ->method('calls')
               ->willReturn([['set', ['bar']]]);

        $service = $this->getCleanMock(Config::class);

        $this->assertInstanceOf(Config::class, $mock->testHydrate($config, $service));
    }

    /**
     *
     */
    public function test_hydrate_array_string_method()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['args', 'hydrate', 'invoke', 'signal', 'testHydrate']);

        $config = $this->getCleanMock(Config::class);

        $config->expects($this->once())
               ->method('calls')
               ->willReturn([
                   ['$bar', '__invoke', 'foo' => 'foo']
               ]);

        $this->assertInstanceOf(Hydrate::class, $mock->testHydrate($config, new Hydrate));
    }

    /**
     *
     */
    public function test_hydrate_array_array_object()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['args', 'hydrate', 'invoke', 'signal', 'testHydrate']);

        $config = $this->getCleanMock(Config::class);

        $config->expects($this->once())
            ->method('calls')
            ->willReturn([
                ['$bar', [new Hydrate, '__invoke'], 'foo' => 'foo']
            ]);

        $this->assertInstanceOf(AutowireNoConstructor::class, $mock->testHydrate($config, new AutowireNoConstructor));
    }

    /**
     *
     */
    public function test_hydrate_array_service()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['hydrate', 'testHydrate']);

        $mock->expects($this->once())
             ->method('invoke');

        $config = $this->getCleanMock(Config::class);

        $config->expects($this->once())
               ->method('calls')
               ->willReturn([[function() {}, ['bar']]]);

        $service = $this->getCleanMock(Config::class);

        $this->assertInstanceOf(Config::class, $mock->testHydrate($config, $service));
    }

    /**
     *
     */
    public function test_hydrate_array_object()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['args', 'resolve', 'hydrate', 'invoke', 'signal', 'testHydrate']);

        $config = $this->getCleanMock(Config::class);

        $config->expects($this->once())
               ->method('param')
               ->willReturn('item');

        $config->expects($this->once())
               ->method('calls')
               ->willReturn([
                   ['$item', new HydrateService, 'index' => 'bar', 'foo' => 'foo']
               ]);

        $this->assertEquals('foo', $mock->testHydrate($config, new \ArrayObject)['bar']);
    }

    /**
     *
     */
    public function test_hydrate_resolvable()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['hydrate', 'testHydrate']);

        $mock->expects($this->once())
             ->method('resolve');

        $config = $this->getCleanMock(Config::class);

        $config->expects($this->once())
               ->method('calls')
               ->willReturn([function() {}]);

        $service = $this->getCleanMock(Config::class);

        $this->assertInstanceOf(Config::class, $mock->testHydrate($config, $service));
    }

    /**
     *
     */
    public function test_hydrate_string_method()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['hydrate', 'testHydrate']);

        $config = $this->getCleanMock(Config::class);

        $config->expects($this->once())
            ->method('calls')
            ->willReturn(['has' => 'bar']);

        $service = $this->getCleanMock(Config::class);

        $service->expects($this->once())
            ->method('has'); //method with single argument

        $this->assertInstanceOf(Config::class, $mock->testHydrate($config, $service));
    }

    /**
     *
     */
    public function test_hydrate_string_array_index()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['hydrate', 'testHydrate']);

        $val = 'bar';

        $mock->expects($this->once())
            ->method('resolve')
            ->willReturn($val);

        $config = $this->getCleanMock(Config::class);

        $config->expects($this->once())
               ->method('calls')
               ->willReturn(['#test' => $val]);

        $service = $this->getCleanMock(Config::class, ['get', 'offsetGet', 'offsetSet', 'set']);

        $this->assertEquals('bar', $mock->testHydrate($config, $service)['test']);
    }

    /**
     *
     */
    public function test_hydrate_string_property()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['hydrate', 'testHydrate']);

        $mock->expects($this->once())
            ->method('resolve');

        $config = $this->getCleanMock(Config::class);

        $config->expects($this->once())
            ->method('calls')
            ->willReturn(['$test' => 'bar']);

        $service = $this->getCleanMock(Config::class);

        $this->assertInstanceOf(Config::class, $mock->testHydrate($config, $service));
    }

    /**
     *
     */
    public function test_invokable_call_string()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['invokable', 'testInvokable']);

        $this->assertInstanceOf(\Closure::class, $mock->testInvokable('@foo'));
    }

    /**
     *
     */
    public function test_invokable_call_string_test()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['invokable', 'testInvokable']);

        $mock->expects($this->once())
             ->method('call')
             ->willReturn('foo');

        $this->assertEquals('foo', call_user_func($mock->testInvokable('@foo')));
    }

    /**
     *
     */
    public function test_invokable_call_array()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['invokable', 'testInvokable']);

        $this->assertEquals(['foo', 'bar'], $mock->testInvokable(['foo', 'bar']));
    }

    /**
     *
     */
    public function test_invokable_call_array_service()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['invokable', 'testInvokable']);

        $mock->expects($this->once())
             ->method('create')
             ->willReturn('foo');

        $this->assertEquals(['foo', 'bar'], $mock->testInvokable([new \stdClass, 'bar']));
    }

    /**
     *
     */
    public function test__invoke()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['invoke', 'testInvoke']);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn('foo');

        $mock->expects($this->any())
             ->method('args')
             ->will($this->onConsecutiveCalls(function() {}, []));

        $this->assertEquals('foo', $mock->testInvoke('foo'));
    }

    /**
     *
     */
    public function test_make()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['make', 'testMake']);

        $mock->expects($this->once())
             ->method('create')
             ->willReturn(new CallEvent);

        $this->assertInstanceOf(Autowire::class, $mock->testMake(Autowire::class, ['foo' => 'bar']));
    }

    /**
     *
     */
    public function test_make_without_constructor()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['make', 'testMake']);

        $this->assertInstanceOf(AutowireNoConstructor::class, $mock->testMake(AutowireNoConstructor::class));
    }

    /**
     *
     */
    public function test_make_no_named_args()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['make', 'testMake']);

        $args = [new CallEvent, 'foo'];

        $mock->expects($this->once())
            ->method('args')
            ->willReturn($args);

        $this->assertInstanceOf(Autowire::class, $mock->testMake(Autowire::class, $args));
    }

    /**
     *
     */
    public function test_make_with_named_args()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['make', 'testMake']);

        $args = ['event' => new CallEvent, 'foo' => 'bar'];

        $mock->expects($this->any())
            ->method('resolve')
            ->will($this->onConsecutiveCalls($args['event'], $args['foo']));

        $this->assertInstanceOf(Autowire::class, $mock->testMake(Autowire::class, $args));
    }

    /**
     *
     */
    public function test_make_with_named_args_but_no_constructor_args()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['make', 'testMake']);

        $args = ['event' => new CallEvent, 'foo' => 'bar'];

        $mock->expects($this->once())
            ->method('args')
            ->willReturn($args);

        $class = AutowireNoConstructorArgs::class;

        $this->assertInstanceOf($class, $mock->testMake($class, $args));
    }

    /**
     *
     */
    public function test_make_with_callback_param()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['make', 'testMake']);

        $event = new CallEvent;

        $mock->expects($this->once())
             ->method('resolve')
             ->willReturn($event);

        $this->assertInstanceOf(
            Autowire::class,
            $mock->testMake(Autowire::class, ['event' => $event], function() { return 'bar'; })
        );
    }

    /**
     *
     */
    public function test_make_with_missing_param()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['make', 'testMake']);

        $this->setExpectedException('RuntimeException');

        $this->assertInstanceOf(AutowireMissingParam::class, $mock->testMake(AutowireMissingParam::class));
    }

    /**
     *
     */
    public function test_merge()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['merge', 'testMerge']);

        $parent = new Config(['name' => 'foo', 'args' => ['foo' => 'bar']]);

        $config = new Config([
            'name' => 'bar',
            'args' => [
                'foo' => 'baz'
            ],
            'calls' => [
                'a' => 'b'
            ],
            'merge' => true
        ]);

        $this->assertInstanceOf(Config::class, $mock->testMerge($parent, $config));
    }

    /**
     *
     */
    public function test_merge_no_parent_name()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['merge', 'testMerge']);

        $mock->expects($this->once())
            ->method('resolve')
            ->willReturn('foo');

        $parent = new Config();

        $config = new Config(['name' => 'bar']);

        $this->assertInstanceOf(Config::class, $mock->testMerge($parent, $config));
    }

    /**
     *
     */
    public function test_merge_no_merge_parent_calls()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['merge', 'testMerge']);

        $parent = new Config(['name' => 'foo']);

        $config = new Config(['name' => 'bar', 'calls' => ['a' => 'b']]);

        $this->assertInstanceOf(Config::class, $mock->testMerge($parent, $config));
    }

    /**
     *
     */
    public function test_param()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['param']);

        $mock->expects($this->once())
             ->method('config')
             ->willReturn(['foo' => ['bar' => 'baz']]);

        $this->assertEquals('baz', $mock->param('foo.bar'));
    }

    /**
     *
     */
    public function test_provide()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['provide', 'testProvide']);

        $mock->expects($this->once())
             ->method('solve')
             ->willReturn('foo');

        $mock->expects($this->once())
             ->method('configured')
             ->willReturn(new Config(['name' => 'foo']));

        $mock->expects($this->once())
             ->method('hydrate')
             ->willReturn('foo');

        $mock->expects($this->once())
             ->method('build')
             ->willReturn(null);

        $config = new Config(['name' => 'foo', 'args' => ['foo' => 'bar']]);

        $this->assertEquals('foo', $mock->testProvide($config, ['foo' => 'baz']));
    }

    /**
     *
     */
    public function test_provide_no_parent_type_config()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['provide', 'testProvide']);

        $mock->expects($this->any())
             ->method('solve')
             ->willReturn('foo');

        $mock->expects($this->once())
             ->method('configured')
             ->willReturn('bar');

        $mock->expects($this->once())
            ->method('hydrate')
            ->willReturn('foo');

        $mock->expects($this->once())
            ->method('create')
            ->willReturn('bar');

        $config = new Config(['name' => 'foo']);

        $this->assertEquals('foo', $mock->testProvide($config));
    }

    /**
     *
     */
    public function test_provide_with_merge()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['provide', 'testProvide']);

        $mock->expects($this->any())
             ->method('solve')
             ->willReturn('foo');

        $mock->expects($this->any())
             ->method('configured')
             ->will($this->onConsecutiveCalls(new Config(['name' => 'bar']), new \StdClass));

        $mock->expects($this->once())
             ->method('merge')
             ->willReturn(new Config(['name' => 'foo']));

        $mock->expects($this->once())
             ->method('hydrate')
             ->willReturn('foo');

        $mock->expects($this->once())
             ->method('create')
             ->willReturn('foo');

        $config = new Config(['name' => 'foo']);

        $this->assertEquals('foo', $mock->testProvide($config));
    }

    /**
     *
     */
    public function test_resolve()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolve', 'testResolve']);

        $this->assertEquals(false, $mock->testResolve(false));
    }

    /**
     *
     */
    public function test_resolve_service_factory()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolve', 'testResolve']);

        $mock->expects($this->once())
             ->method('child');

        $mock->expects($this->once())
            ->method('invoke')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->testResolve(new Factory('foo')));
    }

    /**
     *
     */
    public function test_resolve_service_calls()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolve', 'testResolve']);

        $mock->expects($this->once())
             ->method('hydrate')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->testResolve(new Calls('foo', [])));
    }

    /**
     *
     */
    public function test_resolve_child_service()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolve', 'testResolve']);

        $mock->expects($this->once())
             ->method('child')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->testResolve(new Child('foo', 'bar')));
    }

    /**
     *
     */
    public function test_resolve_config()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolve', 'testResolve']);

        $mock->expects($this->once())
             ->method('provide')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->testResolve(new Config()));
    }

    /**
     *
     */
    public function test_resolve_dependency()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolve', 'testResolve']);

        $mock->expects($this->once())
            ->method('get')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->testResolve(new Dependency('foo')));
    }

    /**
     *
     */
    public function test_resolve_service_param()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolve', 'testResolve']);

        $mock->expects($this->once())
             ->method('param')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->testResolve(new Param('foo')));
    }

    /**
     *
     */
    public function test_resolve_service_call()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolve', 'testResolve']);

        $mock->expects($this->once())
             ->method('call')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->testResolve(new Call('foo')));
    }

    /**
     *
     */
    public function test_resolve_args()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolve', 'testResolve']);

        $mock->expects($this->once())
             ->method('args')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->testResolve(new Args('foo')));
    }

    /**
     *
     */
    public function test_resolve_config_link()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolve', 'testResolve']);

        $mock->expects($this->once())
             ->method('config')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->testResolve(new ConfigLink()));
    }

    /**
     *
     */
    public function test_resolve_service_manager()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolve', 'testResolve']);

        $this->assertEquals($mock, $mock->testResolve(new ServiceManagerLink()));
    }

    /**
     *
     */
    public function test_resolve_filter()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolve', 'testResolve']);

        $mock->expects($this->once())
             ->method('filter')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->testResolve(new Filter('foo')));
    }

    /**
     *
     */
    public function test_resolve_service_config()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolve', 'testResolve']);

        $mock->expects($this->once())
             ->method('configured')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->testResolve(new ServiceConfig('foo')));
    }

    /**
     *
     */
    public function test_resolve_service_invoke()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolve', 'testResolve']);

        $mock->expects($this->once())
            ->method('call')
            ->willReturn('foo');

        $callable = $mock->testResolve(new Invoke('foo'));

        $this->assertEquals('foo', $callable());
    }

    /**
     *
     */
    public function test_resolve_service_invokable()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolve', 'testResolve']);

        $mock->expects($this->once())
            ->method('solve')
            ->willReturn('foo');

        $callable = $mock->testResolve(new Invokable('foo'));

        $this->assertEquals('foo', $callable());
    }

    /**
     *
     */
    public function test_resolve_call()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolve', 'testResolve']);

        $resolvable = $this->getCleanMock(Resolvable::class);

        $mock->expects($this->once())
             ->method('call')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->testResolve($resolvable));
    }

    /**
     *
     */
    public function test_solve()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['solve', 'testSolve']);

        $resolvable = $this->getCleanMock(Resolvable::class);

        $mock->expects($this->once())
            ->method('resolve')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->testSolve($resolvable));
    }

    /**
     *
     */
    public function test_solve_not_resolvable()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['solve', 'testSolve']);

        $this->assertEquals('foo', $mock->testSolve('foo'));
    }

    /**
     *
     */
    public function test_solve__invoke()
    {
        $mock = $this->getCleanAbstractMock(Resolver::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('plugin')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke('foo'));
    }
}
