<?php
/**
 *
 */

namespace Mvc5\Test\Service;

use Mvc5\Service\Service;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    public function test_call()
    {
        /** @var Service|Mock $service */

        $service = $this->getCleanMock(Service::class);

        $service->expects($this->once())
                ->method('call')
                ->willReturn('foo');

        /** @var Plugin $mock */

        $mock = $this->getCleanMock(Plugin::class, ['call', 'callTest'], [$service]);

        $this->assertEquals('foo', $mock->callTest(null));
    }

    /**
     *
     */
    public function test_create()
    {
        /** @var Service|Mock $service */

        $service = $this->getCleanMock(Service::class);

        $service->expects($this->once())
                ->method('create')
                ->willReturn('foo');

        /** @var Plugin $mock */

        $mock = $this->getCleanMock(Plugin::class, ['create', 'createTest'], [$service]);

        $this->assertEquals('foo', $mock->createTest(null));
    }

    /**
     *
     */
    public function test_invokable()
    {
        /** @var Service|Mock $service */

        $service = $this->getCleanMock(Service::class);

        $service->expects($this->once())
                ->method('invokable')
                ->willReturn(function(){});

        /** @var Plugin $mock */

        $mock = $this->getCleanMock(Plugin::class, ['invokable', 'invokableTest'], [$service]);

        $this->assertEquals(function(){}, $mock->invokableTest(null));
    }

    /**
     *
     */
    public function test_param()
    {
        /** @var Service|Mock $service */

        $service = $this->getCleanMock(Service::class);

        $service->expects($this->once())
                ->method('param')
                ->willReturn('foo');

        /** @var Plugin $mock */

        $mock = $this->getCleanMock(Plugin::class, ['param', 'paramTest'], [$service]);

        $this->assertEquals('foo', $mock->paramTest(null));
    }

    /**
     *
     */
    public function test_plugin()
    {
        /** @var Service|Mock $service */

        $service = $this->getCleanMock(Service::class);

        $service->expects($this->once())
                ->method('plugin')
                ->willReturn('foo');

        /** @var Plugin $mock */

        $mock = $this->getCleanMock(Plugin::class, ['plugin', 'pluginTest'], [$service]);

        $this->assertEquals('foo', $mock->pluginTest(null));
    }

    /**
     *
     */
    public function test_trigger()
    {
        /** @var Service|Mock $service */

        $service = $this->getCleanMock(Service::class);

        $service->expects($this->once())
            ->method('trigger')
            ->willReturn('foo');

        /** @var Plugin $mock */

        $mock = $this->getCleanMock(Plugin::class, ['trigger', 'triggerTest'], [$service]);

        $this->assertEquals('foo', $mock->triggerTest(null));
    }
}
