<?php

namespace Mvc5\Test\Config;

use Mvc5\Config\Base;
use Mvc5\Test\Test\TestCase;

class BaseTest
    extends TestCase
{
    /**
     *
     */
    public function test_count()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['count'], [[1, 2, 3, 4, 5]]);

        $this->assertEquals(5, $mock->count());
    }

    /**
     *
     */
    public function test_current()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['current'], [[2]]);

        $this->assertEquals(2, $mock->current());
    }

    /**
     *
     */
    public function test_get_isset()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['get'], [['foo' => 'bar']]);

        $this->assertEquals('bar', $mock->get('foo'));
    }

    /**
     *
     */
    public function test_get_not_isset()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['get']);

        $this->assertEquals(null, $mock->get('foo'));
    }

    /**
     *
     */
    public function test_has()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['has'], [['foo' => 'bar']]);

        $this->assertEquals(true, $mock->has('foo'));
    }

    /**
     *
     */
    public function test_has_not()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['has']);

        $this->assertEquals(false, $mock->has('foo'));
    }

    /**
     *
     */
    public function test_key()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['key'], [['foo' => 'bar']]);

        $this->assertEquals('foo', $mock->key());
    }

    /**
     *
     */
    public function test_next()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['next']);

        $this->assertEquals(null, $mock->next());
    }

    /**
     *
     */
    public function test_remove()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['remove'], [['foo' => 'bar']]);

        $this->assertEquals(null, $mock->remove('foo'));
    }

    /**
     *
     */
    public function test_rewind()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['rewind']);

        $this->assertEquals(null, $mock->rewind());
    }

    /**
     *
     */
    public function test_set()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['set']);

        $this->assertEquals('bar', $mock->set('foo', 'bar'));
    }

    /**
     *
     */
    public function test_valid()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['valid']);

        $mock->expects($this->once())
             ->method('key')
             ->willReturn(1);

        $this->assertEquals(true, $mock->valid());
    }

    /**
     *
     */
    public function test_valid_not()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['valid']);

        $mock->expects($this->once())
            ->method('key')
            ->willReturn(null);

        $this->assertEquals(false, $mock->valid());
    }
}
