<?php
/**
 *
 */

namespace Mvc5\Test\Model\Template;

use Mvc5\App;
use Mvc5\Arg;
use Mvc5\Test\Test\TestCase;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    function test_call()
    {
        $model   = new Model;
        $service = new App([Arg::SERVICES => ['foo' => function() { return function($bar) { return $bar; }; }]]);

        $model->service($service);

        $this->assertEquals('bar', $model->foo('bar'));
    }
}
