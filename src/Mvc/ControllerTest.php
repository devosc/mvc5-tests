<?php
/**
 *
 */

namespace Mvc5\Test\Mvc;

use Mvc5\Arg;
use Mvc5\App;
use Mvc5\Mvc\Controller;
use Mvc5\Test\Test\TestCase;

class ControllerTest
    extends TestCase
{
    /**
     * @return App
     */
    protected function app()
    {
        return new App([
            Arg::SERVICES => [
                'home' => function() {
                    return function() {
                        return 'Home';
                    };
                },
                'exception' => function() {
                    return function() {
                        throw new \Exception;
                    };
                },
                'controller\exception' => function() {
                    return function() {
                        return 'Exception';
                    };
                }
            ]
        ]);
    }

    /**
     *
     */
    function test_invoke()
    {
        $controller = new Controller;

        $controller->service($this->app());

        $this->assertEquals('Home', $controller('home'));
    }

    /**
     *
     */
    function test_invoke_exception()
    {
        $controller = new Controller;

        $controller->service($this->app());

        $this->assertEquals('Exception', $controller('exception'));
    }
}
