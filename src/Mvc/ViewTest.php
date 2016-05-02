<?php
/**
 *
 */

namespace Mvc5\Test\Mvc;

use Mvc5\Arg;
use Mvc5\App;
use Mvc5\Model;
use Mvc5\Mvc\View;
use Mvc5\Test\Test\TestCase;

class ViewTest
    extends TestCase
{
    /**
     * @return App
     */
    protected function app()
    {
        return new App([
            Arg::SERVICES => [
                'view\render' => function() {
                    return function(Model $model) {
                        switch($model->template()) {
                            default:
                                throw new \RuntimeException;
                                break;
                            case 'home':
                                return 'Home';
                                break;
                        }
                    };
                },
                'view\exception' => function() {
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
        $view = new View;

        $this->assertEquals(null, $view(null));
    }

    /**
     *
     */
    function test_invoke_render()
    {
        $view = new View;

        $view->service($this->app());

        $this->assertEquals('Home', $view(new Model('home')));
    }

    /**
     *
     */
    function test_invoke_exception()
    {
        $view = new View;

        $view->service($this->app());

        $this->assertEquals('Exception', $view(new Model('exception')));
    }
}
