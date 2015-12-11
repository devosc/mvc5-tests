<?php
/**
 *
 */

namespace Mvc5\Test\View\Template;

use Mvc5\Arg;
use Mvc5\Model;
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

        $this->assertEquals('foo', $mock->__invoke('foo'));
    }

    /**
     *
     */
    public function test__invoke()
    {
        /** @var Renderer|Mock $mock */

        $mock = $this->getCleanMock(Renderer::class, ['__invoke']);

        $template = __DIR__ . '/index.phtml';

        $config = [Arg::CHILD_MODEL => new Model($template)];

        $model = $this->getCleanMock(Model::class, ['current', 'key', 'next', 'valid'], [$template, $config]);

        $model->expects($this->once())
              ->method('set');

        $model->expects($this->once())
              ->method('template');

        $model->expects($this->any())
              ->method('service');

        $model->expects($this->once())
              ->method('assigned')
              ->willReturn([]);

        $model->expects($this->any())
              ->method('path')
              ->willReturn($template);

        $service = $this->getCleanMock(Service::class);

        $mock->expects($this->any())
             ->method('service')
             ->willReturn($service);

        $mock->expects($this->any())
             ->method('template')
             ->willReturn($template);

        $this->assertEquals('<h1>Home</h1>', trim($mock->__invoke($model)));
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
              ->method('path');

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

        $model->expects($this->once())
              ->method('template');

        $model->expects($this->any())
              ->method('service');

        $model->expects($this->once())
              ->method('assigned')
              ->willReturn([]);

        $model->expects($this->any())
              ->method('path')
              ->willReturn($template);

        $vm = $this->getCleanMock(Service::class);

        $mock->expects($this->any())
             ->method('service')
             ->willReturn($vm);

        $mock->expects($this->any())
             ->method('template')
             ->willReturn($template);

        $this->setExpectedException('Exception');

        $mock->__invoke($model);
    }
}
