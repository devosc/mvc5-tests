<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class GeneratorTest
    extends TestCase
{
    /**
     *
     */
    public function test_emit_callable_event()
    {
        /** @var Generator|Mock $mock */

        $mock = $this->getCleanAbstractMock(Generator::class, ['emit', 'emitTest']);

        $event = function() { return 'foo'; };

        $this->assertEquals('foo', $mock->emitTest($event, function() {}));
    }

    /**
     *
     */
    public function test_emit_listener()
    {
        /** @var Generator|Mock $mock */

        $mock = $this->getCleanAbstractMock(Generator::class, ['emit', 'emitTest']);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->emitTest(null, function() {}));
    }

    /**
     * @return mixed
     */
    public function test_generate()
    {
        /** @var Generator|Mock $mock */

        $mock = $this->getCleanAbstractMock(Generator::class, ['generate', 'generateTest']);

        $event = $this->getCleanMock('Mvc5\Event');
        $event->expects($this->once())
              ->method('stopped')
              ->willReturn(true);

        $mock->expects($this->once())
             ->method('queue')
             ->willReturn(['foo']);

        $mock->expects($this->once())
             ->method('callable')
             ->willReturn(function(){});

        $mock->expects($this->once())
             ->method('emit')
             ->willReturn('bar');

        $this->assertEquals('bar', $mock->generateTest($event));
    }

    /**
     *
     */
    public function test_queue_array()
    {
        /** @var Generator|Mock $mock */

        $mock = $this->getCleanAbstractMock(Generator::class, ['queue', 'queueTest']);

        $this->assertEquals(['foo'], $mock->queueTest(['foo']));
    }

    /**
     *
     */
    public function test_queue_traversable()
    {
        /** @var Generator|Mock $mock */

        $mock = $this->getCleanAbstractMock(Generator::class, ['queue', 'queueTest']);

        $this->assertInstanceOf(\Traversable::class, $mock->queueTest($this->getCleanMock('Mvc5\Config')));
    }

    /**
     *
     */
    public function test_queue_string()
    {
        /** @var Generator|Mock $mock */

        $mock = $this->getCleanAbstractMock(Generator::class, ['queue', 'queueTest']);

        $mock->expects($this->once())
             ->method('listeners')
             ->willReturn(['bar']);

        $this->assertEquals(['bar'], $mock->queueTest('foo'));
    }

    /**
     *
     */
    public function test_queue_event()
    {
        /** @var Generator|Mock $mock */

        $mock = $this->getCleanAbstractMock(Generator::class, ['queue', 'queueTest']);

        $event = $this->getCleanMock('Mvc5\Event');
        $event->expects($this->once())
              ->method('event')
              ->willReturn('foo');

        $mock->expects($this->once())
            ->method('listeners')
            ->willReturn(['bar']);

        $this->assertEquals(['bar'], $mock->queueTest($event));
    }

    /**
     *
     */
    public function test_queue_object()
    {
        /** @var Generator|Mock $mock */

        $mock = $this->getCleanAbstractMock(Generator::class, ['queue', 'queueTest']);

        $object = $this->getCleanMock('stdClass');

        $mock->expects($this->once())
            ->method('listeners')
            ->willReturn(['bar']);

        $this->assertEquals(['bar'], $mock->queueTest($object));
    }
}
