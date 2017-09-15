<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\Nothing;
use Mvc5\Test\Test\TestCase;

class NothingTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $app = new App;

        $app['foo'] = new Nothing;

        $this->assertTrue(isset($app['foo']));
        $this->assertInstanceOf(Nothing::class, $app['foo']);
    }
}
