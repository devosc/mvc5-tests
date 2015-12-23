<?php
/**
 *
 */

namespace Mvc5\Test\Service;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ConfigTest
    extends TestCase
{
    /**
     *
     */
    public function test_config_empty()
    {
        /** @var Config $mock */

        $mock = $this->getCleanMock(Config::class, ['config']);

        $this->assertEquals([], $mock->config());
    }

    /**
     *
     */
    public function test_config()
    {
        /** @var Config $mock */

        $mock = $this->getCleanMock(Config::class, ['config']);

        $this->assertEquals(['foo'], $mock->config(['foo']));
    }

    /**
     *
     */
    public function test_configure()
    {
        /** @var Config $mock */

        $mock = $this->getCleanMock(Config::class, ['configure']);

        $mock->configure('foo', 'bar');
    }

    /**
     *
     */
    public function test_configured_null()
    {
        /** @var Config $mock */

        $mock = $this->getCleanMock(Config::class, ['configured']);

        $this->assertEquals(null, $mock->configured('foo'));
    }

    /**
     *
     */
    public function test_configured_not_null()
    {
        /** @var Config $mock */

        $mock = $this->getCleanMock(Config::class, ['configured', 'configure']);

        $mock->configure('foo', 'bar');

        $this->assertEquals('bar', $mock->configured('foo'));
    }

    /**
     *
     */
    public function test_container_empty()
    {
        /** @var Config $mock */

        $mock = $this->getCleanMock(Config::class, ['container']);

        $this->assertEquals([], $mock->container());
    }

    /**
     *
     */
    public function test_container_not_empty()
    {
        /** @var Config $mock */

        $mock = $this->getCleanMock(Config::class, ['container']);

        $this->assertEquals(['foo'], $mock->container(['foo']));
    }

    /**
     *
     */
    public function test_get()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMock(Config::class, ['get']);

        $mock->expects($this->once())
             ->method('shared')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->get(null));
    }

    /**
     *
     */
    public function test_has()
    {
        /** @var Config $mock */

        $mock = $this->getCleanMock(Config::class, ['has']);

        $this->assertEquals(false, $mock->has(null));
    }

    /**
     *
     */
    public function test_remove()
    {
        /** @var Config $mock */

        $mock = $this->getCleanMock(Config::class, ['remove']);

        $mock->remove(null);
    }

    /**
     *
     */
    public function test_shared_null()
    {
        /** @var Config $mock */

        $mock = $this->getCleanMock(Config::class, ['shared', 'sharedTest']);

        $this->assertEquals(null, $mock->sharedTest(null));
    }

    /**
     *
     */
    public function test_shared_not_null()
    {
        /** @var Config $mock */

        $mock = $this->getCleanMock(Config::class, ['set', 'shared', 'sharedTest']);

        $mock->set('foo', 'bar');

        $this->assertEquals('bar', $mock->sharedTest('foo'));
    }

    /**
     *
     */
    public function test_services_empty()
    {
        /** @var Config $mock */

        $mock = $this->getCleanMock(Config::class, ['services']);

        $this->assertEquals([], $mock->services());
    }

    /**
     *
     */
    public function test_services_not_empty()
    {
        /** @var Config $mock */

        $mock = $this->getCleanMock(Config::class, ['services']);

        $this->assertEquals(['foo'], $mock->services(['foo']));
    }

    /**
     *
     */
    public function test_set()
    {
        /** @var Config $mock */

        $mock = $this->getCleanMock(Config::class, ['set']);

        $mock->set('foo', 'bar');
    }
}
