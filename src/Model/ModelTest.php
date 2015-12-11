<?php
/**
 *
 */

namespace Mvc5\Test\Model;

use Mvc5\Model as Mvc5Model;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ModelTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct_template()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanAbstractMock(Model::class, ['path', 'get'], ['foo']);

        $this->assertEquals('foo', $mock->path());
    }

    /**
     *
     */
    public function test_construct_template_const()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanAbstractMock(Model::class, ['path', 'get'], [null]);

        $this->assertEquals('baz', $mock->path());
    }

    /**
     *
     */
    public function test_construct_template_null()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanAbstractMock(Model::class, ['path', 'get']);

        $this->assertEquals(null, $mock->path());
    }

    /**
     *
     */
    public function test_child()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanAbstractMock(Model::class, ['child']);

        $mock->expects($this->once())
             ->method('set');

        $mock->child(null);
    }

    /**
     *
     */
    public function test_assigned()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanAbstractMock(Model::class, ['assigned']);

        $this->assertEquals([], $mock->assigned());
    }

    /**
     *
     */
    public function test_model()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanAbstractMock(Model::class, ['model']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->model());
    }

    /**
     *
     */
    public function test_path()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanAbstractMock(Model::class, ['path']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->path());
    }

    /**
     *
     */
    public function test_template()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanAbstractMock(Model::class, ['template']);

        $mock->expects($this->once())
             ->method('set')
             ->willReturn('foo');

        $mock->template(null);
    }

    /**
     *
     */
    public function test_vars()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanAbstractMock(Model::class, ['vars']);

        $mock->expects($this->once())
             ->method('path')
             ->willReturn('foo');

        $mock->expects($this->once())
             ->method('model')
             ->willReturn('bar');

        $mock->vars([]);
    }

    /**
     *
     */
    public function test_call()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanAbstractMock(Model::class, ['__call']);

        $mock->expects($this->once())
             ->method('call')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__call(null));
    }

    /**
     *
     */
    public function test_get()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanAbstractMock(Model::class, ['__get']);

        $mock->expects($this->once())
            ->method('get')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->__get(null));
    }

    /**
     *
     */
    public function test_isset()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanAbstractMock(Model::class, ['__isset']);

        $mock->expects($this->once())
            ->method('has')
            ->willReturn(true);

        $this->assertEquals(true, $mock->__isset(null));
    }

    /**
     *
     */
    public function test_set()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanAbstractMock(Model::class, ['__set']);

        $mock->expects($this->once())
            ->method('set');

        $mock->__set(null, null);
    }

    /**
     *
     */
    public function test_unset()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanAbstractMock(Model::class, ['__unset']);

        $mock->expects($this->once())
            ->method('remove');

        $mock->__unset(null);
    }
}
