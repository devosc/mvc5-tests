<?php
/**
 *
 */

namespace Mvc5\Test\Service;

use Mvc5\App;
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
        $params = ['foo' => ['bar' => 'baz'],  'bar' => 'baz'];

        $app = new App($params);

        Context::bind($app);

        $this->assertEquals('baz', ServiceFacade::param('foo.bar'));
        $this->assertEquals(['bar' => 'baz'], ServiceFacade::param('foo'));
        $this->assertEquals($params + ['foobar' => null], ServiceFacade::param(['foo', 'bar', 'foobar']));

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
                'foo' => 'bar',
                'baz' => 'bat',
                'foobar' => $plugin
            ],
        ]);

        Context::bind($app);

        $this->assertEquals('bar', ServiceFacade::shared('foo'));
        $this->assertEquals($plugin, ServiceFacade::shared('foobar'));
        $this->assertEquals(['foo' => 'bar',  'baz' => 'bat'], ServiceFacade::shared(['foo', 'baz']));
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
