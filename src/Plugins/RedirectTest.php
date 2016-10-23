<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\App;
use Mvc5\Response\Redirect;
use Mvc5\Test\Test\TestCase;

class RedirectTest
    extends TestCase
{
    /**
     *
     */
    function test_redirect()
    {
        $config = ['services' => ['response\redirect' => Redirect::class]];

        $plugin = new RedirectPlugin;
        $plugin->service(new App($config));

        $this->assertInstanceOf(Redirect::class, $plugin());
    }
}
