<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Plugin\Plugin;
use Mvc5\Test\Resolver\Resolver\Model\AutowireNoConstructor;
use Mvc5\Test\Resolver\Resolver\Model\Hydrate;
use Mvc5\Test\Resolver\Resolver\Model\HydrateService;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class HydrateTest
    extends TestCase
{
    /**
     *
     */
    public function test_hydrate()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['hydrate', 'hydrateTest']);

        $this->assertEquals(new \stdClass, $mock->hydrateTest(new Plugin(null), new \stdClass));
    }

    /**
     *
     */
    public function test_hydrate_array_with_param()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['hydrate', 'hydrateTest']);

        $mock->expects($this->once())
             ->method('invoke');

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        /** @var Plugin|Mock $config */

        $config = $this->getCleanMock(Plugin::class);

        $config->expects($this->once())
               ->method('param')
               ->willReturn('item');

        $config->expects($this->once())
               ->method('calls')
               ->willReturn([['set', 'foo' => 'bar']]);

        $service = $this->getCleanMock(Plugin::class);

        $this->assertInstanceOf(Plugin::class, $mock->hydrateTest($config, $service));
    }

    /**
     *
     */
    public function test_hydrate_array_without_param()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['hydrate', 'hydrateTest']);

        $mock->expects($this->once())
             ->method('invoke');

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        /** @var Plugin|Mock $config */

        $config = $this->getCleanMock(Plugin::class);

        $config->expects($this->once())
               ->method('calls')
               ->willReturn([['set', 'bar']]);

        $service = $this->getCleanMock(Plugin::class);

        $this->assertInstanceOf(Plugin::class, $mock->hydrateTest($config, $service));
    }

    /**
     *
     */
    public function test_hydrate_array_string_method()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['args', 'hydrate', 'invoke', 'signal', 'hydrateTest']);

        $object = new Hydrate;

        /** @var Plugin|Mock $config */

        $config = $this->getCleanMock(Plugin::class);

        $config->expects($this->once())
               ->method('calls')
               ->willReturn([
                   ['$bar', '__invoke', 'foo' => 'foo']
               ]);

        $this->assertInstanceOf(Hydrate::class, $mock->hydrateTest($config, $object));
    }

    /**
     *
     */
    public function test_hydrate_array_array_object()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['args', 'hydrate', 'invoke', 'signal', 'hydrateTest']);

        $object = new AutowireNoConstructor;

        /** @var Plugin|Mock $config */

        $config = $this->getCleanMock(Plugin::class);

        $config->expects($this->once())
               ->method('calls')
              ->willReturn([
                  ['$bar', [$object, '__invoke'], 'foo' => 'foo']
              ]);

        $this->assertInstanceOf(AutowireNoConstructor::class, $mock->hydrateTest($config, $object));
    }

    /**
     *
     */
    public function test_hydrate_array_service()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['hydrate', 'hydrateTest']);

        $mock->expects($this->once())
             ->method('invoke');

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        /** @var Plugin|Mock $config */

        $config = $this->getCleanMock(Plugin::class);

        $config->expects($this->once())
               ->method('calls')
               ->willReturn([[function() {}, ['bar']]]);

        $service = $this->getCleanMock(Plugin::class);

        $this->assertInstanceOf(Plugin::class, $mock->hydrateTest($config, $service));
    }

    /**
     *
     */
    public function test_hydrate_array_object()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['args', 'resolve', 'hydrate', 'invoke', 'signal', 'hydrateTest']);

        $object = new HydrateService;

        /** @var Plugin|Mock $config */

        $config = $this->getCleanMock(Plugin::class);

        $config->expects($this->once())
               ->method('param')
               ->willReturn('item');

        $config->expects($this->once())
               ->method('calls')
               ->willReturn([
                ['$item', $object, 'index' => 'bar', 'foo' => 'foo']
               ]);

        $this->assertEquals('foo', $mock->hydrateTest($config, new \ArrayObject)['bar']);
    }

    /**
     *
     */
    public function test_hydrate_resolvable()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['hydrate', 'hydrateTest']);

        $mock->expects($this->once())
             ->method('resolve');

        /** @var Plugin|Mock $config */

        $config = $this->getCleanMock(Plugin::class);

        $config->expects($this->once())
               ->method('calls')
               ->willReturn([function() {}]);

        $service = $this->getCleanMock(Plugin::class);

        $this->assertInstanceOf(Plugin::class, $mock->hydrateTest($config, $service));
    }

    /**
     *
     */
    public function test_hydrate_string_method()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['hydrate', 'hydrateTest']);

        /** @var Plugin|Mock $config */

        $config = $this->getCleanMock(Plugin::class);

        $config->expects($this->once())
               ->method('calls')
               ->willReturn(['has' => 'bar']);

        $service = $this->getCleanMock(Plugin::class);

        $service->expects($this->once())
                ->method('has'); //method with single argument

        $this->assertInstanceOf(Plugin::class, $mock->hydrateTest($config, $service));
    }

    /**
     *
     */
    public function test_hydrate_string_array_index()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['hydrate', 'hydrateTest']);

        $val = 'bar';

        $mock->expects($this->once())
             ->method('resolve')
             ->willReturn($val);

        /** @var Plugin|Mock $config */

        $config = $this->getCleanMock(Plugin::class);

        $config->expects($this->once())
               ->method('calls')
               ->willReturn(['#test' => $val]);

        $service = $this->getCleanMock(Plugin::class, ['get', 'offsetGet', 'offsetSet', 'set']);

        $this->assertEquals('bar', $mock->hydrateTest($config, $service)['test']);
    }

    /**
     *
     */
    public function test_hydrate_string_property()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['hydrate', 'hydrateTest']);

        $mock->expects($this->once())
             ->method('resolve');

        /** @var Plugin|Mock $config */

        $config = $this->getCleanMock(Plugin::class);

        $config->expects($this->once())
               ->method('calls')
               ->willReturn(['$test' => 'bar']);

        $service = $this->getCleanMock(Plugin::class);

        $this->assertInstanceOf(Plugin::class, $mock->hydrateTest($config, $service));
    }
}
