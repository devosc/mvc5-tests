<?php

namespace Mvc5\Test\Route;

use Mvc5\Route\Base;
use Mvc5\Test\Test\TestCase;

class BaseTest
    extends TestCase
{
    /**
     *
     */
    public function test_controller()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['controller']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->controller());
    }

    /**
     *
     */
    public function test_hostname()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['hostname']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->hostname());
    }

    /**
     *
     */
    public function test_length()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['length']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn(2);

        $this->assertEquals(2, $mock->length());
    }

    /**
     *
     */
    public function test_length_zero()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['length']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn(null);

        $this->assertEquals(0, $mock->length());
    }

    /**
     *
     */
    public function test_matched()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['matched']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn(true);

        $this->assertEquals(true, $mock->matched());
    }

    /**
     *
     */
    public function test_matched_false()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['matched']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn(null);

        $this->assertEquals(false, $mock->matched());
    }

    /**
     *
     */
    public function test_method()
    {
        $method = new BaseMethod(['method' => 'foo']);

        $this->assertEquals('foo', $method->method());
    }

    /**
     *
     */
    public function test_name()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['name']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->name());
    }

    /**
     *
     */
    public function test_params()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['params']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->params());
    }

    /**
     *
     */
    public function test_params_empty()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['params']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn(null);

        $this->assertEquals([], $mock->params());
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
    public function test_scheme()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['scheme']);

        $mock->expects($this->once())
            ->method('get')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->scheme());
    }
}
