<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\App;
use Mvc5\Model;
use Mvc5\Test\Test\TestCase;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    function test_service_empty()
    {
        $model = new Model;

        $this->assertNull($model->service());
    }

    /**
     *
     */
    function test_service_not_empty()
    {
        $app = new App;
        $model = new Model;

        $this->assertEquals($app, $model->service($app));
    }
}
