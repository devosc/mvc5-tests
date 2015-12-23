<?php
/**
 *
 */

namespace Mvc5\Test\Model\Template;

use Mvc5\Arg;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class LayoutTest
    extends TestCase
{
    /**
     *
     */
    public function test_model()
    {
        /** @var Layout|Mock $mock */

        $mock = $this->getCleanMock(Layout::class, ['model', 'offsetGet'], [null, [Arg::CHILD_MODEL => 'foo']]);

        $this->assertEquals('foo', $mock->model());
    }

    /**
     *
     */
    public function test_model_set()
    {
        /** @var Layout|Mock $mock */

        $mock = $this->getCleanMock(Layout::class, ['model', 'offsetSet']);

        $this->assertEquals(['foo' => 'bar'], $mock->model(['foo' => 'bar']));
    }

    /**
     *
     */
    public function test_vars()
    {
        /** @var Layout|Mock $mock */

        $mock = $this->getCleanMock(Layout::class, ['vars']);

        $this->assertEquals([], $mock->vars());
    }

    /**
     *
     */
    public function test_vars_set()
    {
        /** @var Layout|Mock $mock */

        $mock = $this->getCleanMock(Layout::class, ['vars']);

        $this->assertEquals(['foo'], $mock->vars(['foo']));
    }
}
