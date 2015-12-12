<?php
/**
 *
 */

namespace Mvc5\Test\Model\Template;

use Mvc5\Model\Template\Layout;
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

        $mock = $this->getCleanMockForTrait(Layout::class, ['model']);

        $mock->expects($this->once())
             ->method('get');

        $mock->model(null);
    }

    /**
     *
     */
    public function test_model_set()
    {
        /** @var Layout|Mock $mock */

        $mock = $this->getCleanMockForTrait(Layout::class, ['model']);

        $mock->expects($this->once())
             ->method('set');

        $mock->model([]);
    }

    /**
     *
     */
    public function test_vars()
    {
        /** @var Layout|Mock $mock */

        $mock = $this->getCleanMockForTrait(Layout::class, ['vars']);

        $this->assertEquals([], $mock->vars());
    }

    /**
     *
     */
    public function test_vars_set()
    {
        /** @var Layout|Mock $mock */

        $mock = $this->getCleanMockForTrait(Layout::class, ['vars']);

        $this->assertEquals(['foo'], $mock->vars(['foo']));
    }
}
