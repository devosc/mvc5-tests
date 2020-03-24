<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\App;
use Mvc5\Http\HttpRequest;
use Mvc5\Http\HttpResponse;
use Mvc5\Test\Test\TestCase;
use Mvc5\Test\View\HomeModel as Model;
use Mvc5\View\Engine\PhpEngine;
use Mvc5\View\Render as ViewRenderer;
use Mvc5\Web\Render;

use const Mvc5\BODY;

class RenderTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $render = new Render(new ViewRenderer(new App, new PhpEngine));

        $request  = new HttpRequest;
        $response = new HttpResponse([BODY => new Model]);

        $next = fn(HttpRequest $request, HttpResponse $response) => $response;

        $response = $render($request, $response, $next);

        $this->assertEquals('<h1>Home</h1>', trim($response[BODY]));
    }
}
