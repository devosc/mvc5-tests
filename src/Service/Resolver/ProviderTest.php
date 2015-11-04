<?php

namespace Mvc5\Test\Service\Resolver;

use Mvc5\Event\Manager\EventManager;
use Mvc5\Service\Container\ServiceContainer;
use Mvc5\Service\Manager\ServiceManager;
use Mvc5\Service\Resolver\Provider;
use Mvc5\Test\Test\TestCase;

class ProviderTest
    extends TestCase
{
    /**
     *
     */
    public function test_config()
    {
        $mock = $this->getCleanMockForTrait(Provider::class, ['config', 'provider']);

        $provider = $this->getCleanMock(ServiceContainer::class);

        $provider->expects($this->once())
                 ->method('config')
                 ->willReturn('foo');

        $mock->provider($provider);

        $this->assertEquals('foo', $mock->config());
    }

    /**
     *
     */
    public function test_configured()
    {
        $mock = $this->getCleanMockForTrait(Provider::class, ['configured', 'provider']);

        $provider = $this->getCleanMock(ServiceContainer::class);

        $provider->expects($this->once())
                 ->method('configured')
                 ->willReturn('foo');

        $mock->provider($provider);

        $this->assertEquals('foo', $mock->configured('foo'));
    }

    /**
     *
     */
    public function test_create()
    {
        $mock = $this->getCleanMockForTrait(Provider::class, ['create', 'provider']);

        $provider = $this->getCleanMock(ServiceManager::class);

        $provider->expects($this->once())
                 ->method('create')
                 ->willReturn('foo');

        $mock->provider($provider);

        $this->assertEquals('foo', $mock->create('foo'));
    }

    /**
     *
     */
    public function test_get()
    {
        $mock = $this->getCleanMockForTrait(Provider::class, ['get', 'provider']);

        $provider = $this->getCleanMock(ServiceContainer::class);

        $provider->expects($this->once())
                 ->method('get')
                 ->willReturn('foo');

        $mock->provider($provider);

        $this->assertEquals('foo', $mock->get('foo'));
    }

    /**
     *
     */
    public function test_plugin()
    {
        $mock = $this->getCleanMockForTrait(Provider::class, ['plugin', 'provider']);

        $provider = $this->getCleanMock(ServiceManager::class);

        $provider->expects($this->once())
                 ->method('plugin')
                 ->willReturn('foo');

        $mock->provider($provider);

        $this->assertEquals('foo', $mock->plugin('foo'));
    }

    /**
     *
     */
    public function test_provider()
    {
        $mock = $this->getCleanMockForTrait(Provider::class, ['provider']);

        $provider = $this->getCleanMock(EventManager::class);

        $this->assertEquals(null, $mock->provider($provider));
    }

    /**
     *
     */
    public function test_trigger()
    {
        $mock = $this->getCleanMockForTrait(Provider::class, ['trigger', 'provider']);

        $provider = $this->getCleanMock(EventManager::class);

        $provider->expects($this->once())
                 ->method('trigger')
                 ->willReturn('foo');

        $mock->provider($provider);

        $this->assertEquals('foo', $mock->trigger('foo'));
    }
}
