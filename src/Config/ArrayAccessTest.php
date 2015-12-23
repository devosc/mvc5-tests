<?php
/**
 *
 */

namespace Mvc5\Test\Config;

use Mvc5\Config\ArrayAccess;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ArrayAccessTest
    extends TestCase
{
    /**
     *
     */
    public function test_count()
    {
        /** @var ArrayAccess|Mock $mock */

        $mock = $this->getCleanMockForTrait(ArrayAccess::class, ['count'], [[1, 2, 3, 4, 5]]);

        $this->assertEquals(5, $mock->count());
    }

    /**
     *
     */
    public function test_current()
    {
        /** @var ArrayAccess|Mock $mock */

        $mock = $this->getCleanMockForTrait(ArrayAccess::class, ['current'], [[2]]);

        $this->assertEquals(2, $mock->current());
    }

    /**
     *
     */
    public function test_offsetGet_isset()
    {
        /** @var ArrayAccess|Mock $mock */

        $mock = $this->getCleanMockForTrait(ArrayAccess::class, ['offsetGet'], [['foo' => 'bar']]);

        $this->assertEquals('bar', $mock->offsetGet('foo'));
    }

    /**
     *
     */
    public function test_get_not_isset()
    {
        /** @var ArrayAccess|Mock $mock */

        $mock = $this->getCleanMockForTrait(ArrayAccess::class, ['offsetGet']);

        $this->assertEquals(null, $mock->offsetGet('foo'));
    }

    /**
     *
     */
    public function test_has()
    {
        /** @var ArrayAccess|Mock $mock */

        $mock = $this->getCleanMockForTrait(ArrayAccess::class, ['offsetExists'], [['foo' => 'bar']]);

        $this->assertEquals(true, $mock->offsetExists('foo'));
    }

    /**
     *
     */
    public function test_has_not()
    {
        /** @var ArrayAccess|Mock $mock */

        $mock = $this->getCleanMockForTrait(ArrayAccess::class, ['offsetExists']);

        $this->assertEquals(false, $mock->offsetExists('foo'));
    }

    /**
     *
     */
    public function test_key()
    {
        /** @var ArrayAccess|Mock $mock */

        $mock = $this->getCleanMockForTrait(ArrayAccess::class, ['key'], [['foo' => 'bar']]);

        $this->assertEquals('foo', $mock->key());
    }

    /**
     *
     */
    public function test_next()
    {
        /** @var ArrayAccess|Mock $mock */

        $mock = $this->getCleanMockForTrait(ArrayAccess::class, ['next']);

        $mock->next();
    }

    /**
     *
     */
    public function test_remove()
    {
        /** @var ArrayAccess|Mock $mock */

        $mock = $this->getCleanMockForTrait(ArrayAccess::class, ['offsetUnset'], [['foo' => 'bar']]);

        $mock->offsetUnset('foo');
    }

    /**
     *
     */
    public function test_rewind()
    {
        /** @var ArrayAccess|Mock $mock */

        $mock = $this->getCleanMockForTrait(ArrayAccess::class, ['rewind']);

        $mock->rewind();
    }

    /**
     *
     */
    public function test_set()
    {
        /** @var ArrayAccess|Mock $mock */

        $mock = $this->getCleanMockForTrait(ArrayAccess::class, ['offsetSet']);

        $this->assertEquals('bar', $mock->offsetSet('foo', 'bar'));
    }

    /**
     *
     */
    public function test_valid()
    {
        /** @var ArrayAccess|Mock $mock */

        $mock = $this->getCleanMockForTrait(ArrayAccess::class, ['valid']);

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
        /** @var ArrayAccess|Mock $mock */

        $mock = $this->getCleanMockForTrait(ArrayAccess::class, ['valid']);

        $mock->expects($this->once())
            ->method('key')
            ->willReturn(null);

        $this->assertEquals(false, $mock->valid());
    }
}
