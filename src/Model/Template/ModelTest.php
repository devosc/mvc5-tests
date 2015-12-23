<?php
/**
 *
 */

namespace Mvc5\Test\Model\Template;

use Mvc5\Arg;
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

        $mock = $this->getCleanMock(Model::class, ['template', 'offsetGet'], ['foo']);

        $this->assertEquals('foo', $mock->template());
    }

    /**
     *
     */
    public function test_construct_template_const()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanMock(Model::class, ['template', 'offsetGet'], [null]);

        $this->assertEquals('baz', $mock->template());
    }

    /**
     *
     */
    public function test_construct_template_null()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanMock(Model::class, ['template', 'offsetGet']);

        $this->assertEquals(null, $mock->template());
    }

    /**
     *
     */
    public function test_template()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanMock(Model::class, ['template']);

        $mock->expects($this->once())
            ->method('offsetGet')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->template());
    }

    /**
     *
     */
    public function test_template_set()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanMock(Model::class, ['template']);

        $mock->expects($this->once())
             ->method('offsetSet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->template('foo'));
    }

    /**
     *
     */
    public function test_vars()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanMock(Model::class, ['vars']);

        $this->assertEquals([], $mock->vars());
    }

    /**
     *
     */
    public function test_vars_set()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanMock(Model::class, ['vars']);

        $mock->expects($this->once())
             ->method('template')
             ->willReturn('foo');

        $this->assertEquals([Arg::TEMPLATE_MODEL => 'foo', 'bar' => 'baz'], $mock->vars(['bar' => 'baz']));
    }

    /**
     *
     */
    public function test_get()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanMock(Model::class, ['__get']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__get(null));
    }

    /**
     *
     */
    public function test_isset()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanMock(Model::class, ['__isset']);

        $mock->expects($this->once())
             ->method('offsetExists')
             ->willReturn(true);

        $this->assertEquals(true, $mock->__isset(null));
    }

    /**
     *
     */
    public function test_set()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanMock(Model::class, ['__set']);

        $mock->expects($this->once())
             ->method('offsetSet');

        $mock->__set(null, null);
    }

    /**
     *
     */
    public function test_unset()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanMock(Model::class, ['__unset']);

        $mock->expects($this->once())
             ->method('offsetUnset');

        $mock->__unset(null);
    }
}
