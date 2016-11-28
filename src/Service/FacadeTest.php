<?php
/**
 *
 */

namespace Mvc5\Test\Service;

use Mvc5\App;
use Mvc5\Plugin\Invokable;
use Mvc5\Plugin\Plugin;
use Mvc5\Plugin\Shared;
use Mvc5\Service\Context;
use Mvc5\Test\Test\TestCase;

/**
 * @runTestsInSeparateProcesses
 */
class FacadeTest
    extends TestCase
{
    /**
     *
     */
    function test_call()
    {
        $app = new App([
            'services' => [
                'foo' => function() {
                    return function() {
                      return 'bar';
                    };
                }
            ]
        ]);

        Context::bind($app);

        $this->assertEquals('bar', ServiceFacade::call('foo'));
    }

    /**
     *
     */
    function test_param()
    {
        $app = new App([
            'foo' => 'bar'
        ]);

        Context::bind($app);

        $this->assertEquals('bar', ServiceFacade::param('foo'));
    }

    /**
     *
     */
    function test_plugin()
    {
        $plugin = new \stdClass;

        $app = new App([
            'services' => [
                'foo' => $plugin
            ]
        ]);

        Context::bind($app);

        $this->assertEquals($plugin, ServiceFacade::plugin('foo'));
    }

    /**
     *
     */
    function test_service()
    {
        $app = new App;

        Context::bind($app);

        $this->assertEquals($app, ServiceFacade::service());
    }

    /**
     *
     */
    function test_shared()
    {
        $plugin = new \stdClass;

        $app = new App([
            'container' => [
                'foo' => $plugin
            ],
            'services' => [
                'shared' => new Invokable(new Plugin(Shared::class)),
            ]
        ], null, true);

        Context::bind($app);

        $this->assertEquals($plugin, ServiceFacade::shared('foo'));
    }

    /**
     *
     */
    function test_trigger()
    {
        $app = new App([
            'events' => [
                'foo' => [
                    function() {
                        return 'bar';
                    }
                ]
            ]
        ]);

        Context::bind($app);

        $this->assertEquals('bar', ServiceFacade::trigger('foo'));
    }
}
