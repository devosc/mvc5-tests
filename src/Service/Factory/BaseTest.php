<?php

namespace Mvc5\Test\Service\Factory;

use Mvc5\Service\Factory\Base;
use Mvc5\Test\Test\TestCase;

class BaseTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $sm = $this->getCleanMock(ServiceManager::class);

        $mock = $this->getCleanMockForTrait(Base::class, ['__construct']);

        $this->assertEquals(null, $mock->__construct($sm));
    }

    /**
     *
     */
    public function test_config()
    {
        $sm = $this->getCleanMock(ServiceManager::class);

        $sm->expects($this->once())
           ->method('config');

        $mock = $this->getCleanMockForTrait(Base::class, ['config'], [$sm]);

        $this->assertEquals(null, $mock->config());
    }

    /**
     *
     */
    public function test_configured()
    {
        $sm = $this->getCleanMock(ServiceManager::class);

        $sm->expects($this->once())
           ->method('configured')
           ->willReturn('bar');

        $mock = $this->getCleanMockForTrait(Base::class, ['configured'], [$sm]);

        $this->assertEquals('bar', $mock->configured('foo'));
    }

    /**
     *
     */
    public function test_create()
    {
        $sm = $this->getCleanMock(ServiceManager::class);

        $sm->expects($this->once())
            ->method('create')
            ->willReturn('bar');

        $mock = $this->getCleanMockForTrait(Base::class, ['create'], [$sm]);

        $this->assertEquals('bar', $mock->create('foo'));
    }

    /**
     *
     */
    public function test_get()
    {
        $sm = $this->getCleanMock(ServiceManager::class);

        $sm->expects($this->once())
            ->method('get')
            ->willReturn('bar');

        $mock = $this->getCleanMockForTrait(Base::class, ['get'], [$sm]);

        $this->assertEquals('bar', $mock->get('foo'));
    }

    /**
     *
     */
    public function test_param()
    {
        $sm = $this->getCleanMock(ServiceManager::class);

        $sm->expects($this->once())
           ->method('param')
           ->willReturn('bar');

        $mock = $this->getCleanMockForTrait(Base::class, ['param'], [$sm]);

        $this->assertEquals('bar', $mock->param('foo'));
    }

    /**
     *
     */
    public function test_service()
    {
        $sm = $this->getCleanMock(ServiceManager::class);

        $sm->expects($this->once())
           ->method('service')
           ->willReturn('bar');

        $mock = $this->getCleanMockForTrait(Base::class, ['service'], [$sm]);

        $this->assertEquals('bar', $mock->service('foo'));
    }
}
