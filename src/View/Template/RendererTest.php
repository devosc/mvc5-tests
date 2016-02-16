<?php
/**
 *
 */

namespace Mvc5\Test\View\Template;

use Mvc5\Arg;
use Mvc5\Model;
use Mvc5\Layout;
use Mvc5\Service\Service;
use Mvc5\View\Template\Renderer;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class RendererTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $this->getCleanMock(Renderer::class, [], [null]);
    }

    /**
     *
     */
    public function test_not_a_view_model()
    {
        /** @var Renderer|Mock $mock */

        $mock = $this->getCleanMock(Renderer::class, ['__invoke']);

        $this->assertEquals(null, $mock->__invoke('foo'));
    }

    /**
     *
     */
    public function test_invoke()
    {
        /** @var Renderer $mock */

        $renderer = new Renderer;

        $model = new HomeModel(__DIR__ . '/index.phtml', ['title' => 'foo']);

        $layout = new Layout(__DIR__ . '/layout.phtml', [Arg::CHILD_MODEL => $model]);

        $this->assertEquals('<h1>Home</h1>', trim($renderer($layout)));
    }

    /**
     *
     */
    public function test_invoke_no_template_exception()
    {
        /** @var Renderer|Mock $mock */

        $mock = $this->getCleanMock(Renderer::class, ['__invoke']);

        $model = $this->getCleanMock(Model::class, ['current', 'key', 'next', 'valid']);

        $model->expects($this->any())
              ->method('template');

        $this->setExpectedException('RuntimeException');

        $mock->__invoke($model);
    }

    /**
     *
     */
    public function test_invoke_exception()
    {
        /** @var Renderer|Mock $mock */

        $mock = $this->getCleanMock(Renderer::class, ['__invoke']);

        $template = __DIR__ . '/exception.phtml';

        $model = $this->getCleanMock(Model::class, ['current', 'key', 'next', 'valid'], [$template]);

        $model->expects($this->any())
              ->method('template');

        $model->expects($this->any())
              ->method('service');

        $vm = $this->getCleanMock(Service::class);

        $mock->expects($this->any())
             ->method('service')
             ->willReturn($vm);

        $mock->expects($this->any())
             ->method('template')
             ->willReturn($template);

        $this->setExpectedException('Exception', 'Model template not found');

        $mock->__invoke($model);
    }
}
