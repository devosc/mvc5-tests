<?php

namespace Mvc5\Test\Service\Container;

use Mvc5\Service\Container\Container;
use Mvc5\Test\Test\TestCase;

class ContainerTest
    extends TestCase
{
    /**
     *
     */
    public function test_config()
    {
        $mock = $this->getCleanMockForTrait(Container::class, ['config']);

        $this->assertEquals(null, $mock->config());
    }

    /**
     *
     */
    public function test_configuration()
    {
        $mock = $this->getCleanMockForTrait(Container::class, ['configuration']);

        $this->assertEquals(null, $mock->configuration([]));
    }

    /**
     *
     */
    public function test_configure()
    {
        $mock = $this->getCleanMockForTrait(Container::class, ['configure']);

        $this->assertEquals(null, $mock->configure('foo', 'bar'));
    }

    /**
     *
     */
    public function test_configured()
    {
        $mock = $this->getCleanMockForTrait(Container::class, ['configured', 'configure']);

        $mock->configure('foo', 'bar');

        $this->assertEquals('bar', $mock->configured('foo'));
    }

    /**
     *
     */
    public function test_configured_not_exists()
    {
        $mock = $this->getCleanMockForTrait(Container::class, ['configured']);

        $this->assertEquals(null, $mock->configured('foo'));
    }

    /**
     *
     */
    public function test_container()
    {
        $mock = $this->getCleanMockForTrait(Container::class, ['container']);

        $this->assertEquals(null, $mock->container([]));
    }

    /**
     *
     */
    public function test_get()
    {
        $mock = $this->getCleanMockForTrait(Container::class, ['get']);

        $mock->expects($this->once())
            ->method('service')
            ->willReturn('bar');

        $this->assertEquals('bar', $mock->get('foo'));
    }

    /**
     *
     */
    public function test_has()
    {
        $mock = $this->getCleanMockForTrait(Container::class, ['has']);

        $this->assertEquals(false, $mock->has('foo'));
    }

    /**
     *
     */
    public function test_remove()
    {
        $mock = $this->getCleanMockForTrait(Container::class, ['remove']);

        $this->assertEquals(null, $mock->remove('foo'));
    }

    /**
     *
     */
    public function test_service()
    {
        $mock = $this->getCleanMockForTrait(Container::class, ['service', 'set']);

        $mock->set('foo', 'bar');

        $this->assertEquals('bar', $mock->service('foo'));
    }

    /**
     *
     */
    public function test_services()
    {
        $mock = $this->getCleanMockForTrait(Container::class, ['services']);

        $this->assertEquals(null, $mock->services([]));
    }

    /**
     *
     */
    public function test_set()
    {
        $mock = $this->getCleanMockForTrait(Container::class, ['set']);

        $this->assertEquals('bar', $mock->set('foo', 'bar'));
    }
}
