<?php
/**
 *
 */

namespace Mvc5\Test\Config;

use Mvc5\Config\Config;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ConfigTest
    extends TestCase
{
    /**
     *
     */
    public function test_count()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMockForTrait(Config::class, ['count'], [[1, 2, 3, 4, 5]]);

        $this->assertEquals(5, $mock->count());
    }

    /**
     *
     */
    public function test_current()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMockForTrait(Config::class, ['current'], [[2]]);

        $this->assertEquals(2, $mock->current());
    }

    /**
     *
     */
    public function test_get_isset()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMockForTrait(Config::class, ['get'], [['foo' => 'bar']]);

        $this->assertEquals('bar', $mock->get('foo'));
    }

    /**
     *
     */
    public function test_get_not_isset()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMockForTrait(Config::class, ['get']);

        $this->assertEquals(null, $mock->get('foo'));
    }

    /**
     *
     */
    public function test_has()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMockForTrait(Config::class, ['has'], [['foo' => 'bar']]);

        $this->assertEquals(true, $mock->has('foo'));
    }

    /**
     *
     */
    public function test_has_not()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMockForTrait(Config::class, ['has']);

        $this->assertEquals(false, $mock->has('foo'));
    }

    /**
     *
     */
    public function test_key()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMockForTrait(Config::class, ['key'], [['foo' => 'bar']]);

        $this->assertEquals('foo', $mock->key());
    }

    /**
     *
     */
    public function test_next()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMockForTrait(Config::class, ['next']);

        $mock->next();
    }

    /**
     *
     */
    public function test_remove()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMockForTrait(Config::class, ['remove'], [['foo' => 'bar']]);

        $mock->remove('foo');
    }

    /**
     *
     */
    public function test_rewind()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMockForTrait(Config::class, ['rewind']);

        $mock->rewind();
    }

    /**
     *
     */
    public function test_set()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMockForTrait(Config::class, ['set']);

        $this->assertEquals('bar', $mock->set('foo', 'bar'));
    }

    /**
     *
     */
    public function test_valid()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMockForTrait(Config::class, ['valid']);

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
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMockForTrait(Config::class, ['valid']);

        $mock->expects($this->once())
            ->method('key')
            ->willReturn(null);

        $this->assertEquals(false, $mock->valid());
    }
}
