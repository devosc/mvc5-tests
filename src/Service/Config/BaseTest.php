<?php

namespace Mvc5\Test\Service\Config;

use Mvc5\Service\Config\Base;
use Mvc5\Test\Test\TestCase;

class BaseTest
    extends TestCase
{
    /**
     *
     */
    public function test_args()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['args']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->args());
    }

    /**
     *
     */
    public function test_args_not_exist()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['args']);

        $mock->expects($this->once())
             ->method('get');

        $this->assertEquals([], $mock->args());
    }
    
    /**
     *
     */
    public function test_calls()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['calls']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->calls());
    }

    /**
     *
     */
    public function test_calls_not_exist()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['calls']);

        $mock->expects($this->once())
             ->method('get');

        $this->assertEquals([], $mock->calls());
    }

    /**
     *
     */
    public function test_merge()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['merge']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->merge());
    }

    /**
     *
     */
    public function test_merge_not_exist()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['merge']);

        $mock->expects($this->once())
             ->method('get');

        $this->assertEquals(false, $mock->merge());
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
    public function test_param()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['param']);

        $mock->expects($this->once())
            ->method('get')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->param());
    }

    /**
     *
     */
    public function test_param_not_exist()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['param']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('item');

        $this->assertEquals('item', $mock->param());
    }
}
