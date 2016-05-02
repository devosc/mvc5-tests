<?php
/**
 *
 */

namespace Mvc5\Test\Mvc;

use Mvc5\Arg;
use Mvc5\App;
use Mvc5\Mvc\Error;
use Mvc5\Response\Error\BadRequest;
use Mvc5\Test\Response\Response;
use Mvc5\Test\Test\TestCase;

class ErrorTest
    extends TestCase
{
    /**
     * @return App
     */
    protected function app()
    {
        return new App([
            Arg::SERVICES => [
                'controller\error' => function() {
                    return function() {
                        return 'Error';
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
        $error = new Error;

        $error->service($this->app());

        $this->assertEquals('Error', $error(new Response, new BadRequest));
    }

    /**
     *
     */
    function test_invoke_no_error()
    {
        $error = new Error;

        $this->assertEquals('foo', $error(new Response, 'foo'));
    }
}
