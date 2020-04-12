<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\Link;
use Mvc5\Test\Test\TestCase;

final class LinkTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $app = new App;

        $this->assertEquals($app, $app->plugin(new Link));
    }
}
