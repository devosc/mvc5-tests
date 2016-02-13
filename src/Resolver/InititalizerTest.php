<?php

namespace Mvc5\Test\Resolver;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class InitializerTest
    extends TestCase
{
    /**
     *
     */
    public function test_initialize()
    {
        /** @var Initializer|Mock $mock */

        $mock = $this->getCleanAbstractMock(Initializer::class, ['initialize', 'testInitialize']);

        $mock->expects($this->once())
             ->method('initializing');

        $mock->expects($this->once())
             ->method('plugin');

        $mock->expects($this->once())
             ->method('initialized')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->testInitialize('foo'));
    }

    /**
     *
     */
    public function test_initialize_not_initializing()
    {
        /** @var Initializer|Mock $mock */

        $mock = $this->getCleanAbstractMock(Initializer::class, ['initialize', 'testInitialize']);

        $mock->expects($this->once())
             ->method('initializing')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->testInitialize('foo'));
    }

    /**
     *
     */
    public function test_initialized()
    {
        /** @var Initializer|Mock $mock */

        $mock = $this->getCleanAbstractMock(Initializer::class, ['initialized', 'testInitialized']);

        $this->assertEquals(null, $mock->testInitialized('foo'));
    }

    /**
     *
     */
    public function test_initialized_set()
    {
        /** @var Initializer|Mock $mock */

        $mock = $this->getCleanAbstractMock(Initializer::class, ['initialized', 'testInitialized']);

        $mock->expects($this->once())
             ->method('set');

        $this->assertEquals(true, $mock->testInitialized('foo', true));
    }

    /**
     *
     */
    public function test_initialized_null()
    {
        /** @var Initializer|Mock $mock */

        $mock = $this->getCleanAbstractMock(Initializer::class, ['initialized', 'testInitialized']);

        $this->assertEquals(null, $mock->testInitialized('foo', null));
    }

    /**
     *
     */
    public function test_initialized_with_service()
    {
        /** @var Initializer|Mock $mock */

        $mock = $this->getCleanAbstractMock(Initializer::class, ['initialized', 'testInitialized']);

        $mock->expects($this->once())
             ->method('set');

        $this->assertEquals('bar', $mock->testInitialized('foo', 'bar'));
    }

    /**
     *
     */
    public function test_initializing()
    {
        /** @var Initializer|Mock $mock */

        $mock = $this->getCleanAbstractMock(
            Initializer::class,
            ['initializing', 'testInitializing', 'setPending']
        );

        $mock->setPending(['foo' => true]);

        $this->setExpectedException('RuntimeException');

        $mock->testInitializing('foo');
    }

    /**
     *
     */
    public function test_initializing_not_pending()
    {
        /** @var Initializer|Mock $mock */

        $mock = $this->getCleanAbstractMock(Initializer::class, ['initializing', 'testInitializing']);

        $this->assertEquals(null, $mock->testInitializing('foo'));
    }
}
