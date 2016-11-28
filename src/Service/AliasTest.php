<?php
/**
 *
 */

namespace Mvc5\Test\Service;

use Mvc5\App;
use Mvc5\Service\Alias;
use Mvc5\Test\Test\TestCase;
use Mvc5\View\Render;

/**
 * @runTestsInSeparateProcesses
 */
class AliasTest
    extends TestCase
{
    /**
     *
     */
    function test_alias()
    {
        spl_autoload_register(new Alias(['TestView' => Render::class]));

        $this->assertInstanceOf(Render::class, new \TestView);
    }

    /**
     *
     */
    function test_autowire()
    {
        spl_autoload_register(new Alias(['TestView' => Render::class]));

        $app = new App;

        $service = $app->plugin(AutowireAlias::class);

        $this->assertInstanceOf(Render::class, $service->view());
    }
}
