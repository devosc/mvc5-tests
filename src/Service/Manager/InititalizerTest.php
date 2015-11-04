<?php

namespace Mvc5\Test\Service\Manager;

use Mvc5\Test\Test\TestCase;

class InitializerTest
    extends TestCase
{
    /**
     *
     */
    public function test_initialize()
    {
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
        $mock = $this->getCleanAbstractMock(Initializer::class, ['initialized', 'testInitialized']);

        $this->assertEquals(null, $mock->testInitialized('foo'));
    }

    /**
     *
     */
    public function test_initialized_with_service()
    {
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
        $mock = $this->getCleanAbstractMock(Initializer::class, ['initializing', 'testInitializing']);

        $this->assertEquals(false, $mock->testInitializing('foo'));
    }
}
