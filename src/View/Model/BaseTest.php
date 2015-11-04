<?php

namespace Mvc5\Test\View\Model;

use Mvc5\View\Model\Base;
use Mvc5\View\Model\Model;
use Mvc5\Test\Test\TestCase;

class BaseTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $this->assertInstanceOf(Model::class, new Model());
    }

    /**
     *
     */
    public function test__construct_with_name()
    {
        $this->assertInstanceOf(Model::class, new Model('foo'));
    }

    /**
     *
     */
    public function test__construct_with_constant()
    {
        $this->assertInstanceOf(ModelTemplateConstant::class, new ModelTemplateConstant());
    }

    /**
     *
     */
    public function test_child()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['child']);

        $mock->expects($this->once())
             ->method('set');

        $this->assertEquals(null, $mock->child('foo'));
    }

    /**
     *
     */
    public function test_assigned()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['assigned']);

        $this->assertEquals([], $mock->assigned());
    }

    /**
     *
     */
    public function test_model()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['model']);

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
        $mock = $this->getCleanMockForTrait(Base::class, ['path']);

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
        $mock = $this->getCleanMockForTrait(Base::class, ['template']);

        $mock->expects($this->once())
             ->method('set');

        $this->assertEquals(null, $mock->template('foo'));
    }

    /**
     *
     */
    public function test_vars()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['vars']);

        $mock->expects($this->once())
             ->method('path')
             ->willReturn([]);

        $mock->expects($this->once())
             ->method('model')
             ->willReturn('foo');

        $this->assertEquals(null, $mock->vars());
    }

    /**
     *
     */
    public function test__get()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['__get']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__get('bar'));
    }

    /**
     *
     */
    public function test__isset()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['__isset']);

        $mock->expects($this->once())
             ->method('has')
             ->willReturn(true);

        $this->assertEquals(true, $mock->__isset('bar'));
    }

    /**
     *
     */
    public function test__set()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['__set']);

        $mock->expects($this->once())
             ->method('set');

        $this->assertEquals(null, $mock->__set('foo', 'bar'));
    }

    /**
     *
     */
    public function test__unset()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['__unset']);

        $mock->expects($this->once())
             ->method('remove');

        $this->assertEquals(null, $mock->__unset('bar'));
    }
}
