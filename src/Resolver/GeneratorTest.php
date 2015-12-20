<?php

namespace Mvc5\Test\Resolver;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class GeneratorTest
    extends TestCase
{

    /**
     * @return mixed
     */
    public function test_events()
    {
        /** @var Generator|Mock $mock */

        $mock = $this->getCleanAbstractMock(Generator::class, ['events']);

        $this->assertEquals([], $mock->events());
    }

    /**
     * @return mixed
     */
    public function test_events_return_config()
    {
        /** @var Generator|Mock $mock */

        $mock = $this->getCleanAbstractMock(Generator::class, ['events']);

        $this->assertEquals(['foo'], $mock->events(['foo']));
    }

    /**
     * @return mixed
     */
    public function test_listeners_with_config()
    {
        /** @var Generator|Mock $mock */

        $mock = $this->getCleanAbstractMock(Generator::class, ['events', 'listeners', 'listenersTest']);

        $mock->events(['foo' => 'bar']);

        $this->assertEquals('bar', $mock->listenersTest('foo'));
    }

    /**
     *
     */
    public function test_listeners_without_config()
    {
        /** @var Generator|Mock $mock */

        $mock = $this->getCleanAbstractMock(Generator::class, ['listeners', 'listenersTest']);

        $mock->expects($this->once())
             ->method('signal')
             ->willThrowException(new \RuntimeException);

        $this->setExpectedException('RuntimeException');

        $mock->listenersTest('foo');
    }
}
