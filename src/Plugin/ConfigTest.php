<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\ArrayModel;
use Mvc5\Plugin\Config;
use Mvc5\Test\Test\TestCase;

class ConfigTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $app = new App(['foo' => 'bar']);

        $this->assertEquals(new ArrayModel(['foo' => 'bar']), $app->plugin(new Config));
    }
}
