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
    public function test_offsetGet()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMock(Config::class, ['offsetGet']);

        $mock->expects($this->once())
             ->method('shared')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->offsetGet(null));
    }

    /**
     *
     */
    public function test_offsetExists()
    {
        /** @var Config $mock */

        $mock = $this->getCleanMock(Config::class, ['offsetExists']);

        $this->assertEquals(false, $mock->offsetExists(null));
    }

    /**
     *
     */
    public function test_offsetUnset()
    {
        /** @var Config $mock */

        $mock = $this->getCleanMock(Config::class, ['offsetUnset']);

        $mock->offsetUnset(null);
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

        $mock = $this->getCleanMock(Config::class, ['offsetSet', 'shared', 'sharedTest']);

        $mock->offsetSet('foo', 'bar');

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
    public function test_offsetSet()
    {
        /** @var Config $mock */

        $mock = $this->getCleanMock(Config::class, ['offsetSet']);

        $mock->offsetSet('foo', 'bar');
    }
}
