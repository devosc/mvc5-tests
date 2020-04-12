<?php
/**
 *
 */

namespace Mvc5\Test\Service;

use Mvc5\App;
use Mvc5\Service\Alias;
use Mvc5\Test\Test\TestCase;
use Mvc5\ViewModel;

/**
 * @runTestsInSeparateProcesses
 */
final class AliasTest
    extends TestCase
{
    /**
     *
     */
    function test_alias()
    {
        spl_autoload_register(new Alias(['TestView' => ViewModel::class]));

        $this->assertInstanceOf(ViewModel::class, new \TestView);
    }

    /**
     *
     */
    function test_autowire()
    {
        spl_autoload_register(new Alias(['TestView' => ViewModel::class]));

        $app = new App;

        $service = $app->plugin(AutowireAlias::class);

        $this->assertInstanceOf(ViewModel::class, $service->view());
    }
}
