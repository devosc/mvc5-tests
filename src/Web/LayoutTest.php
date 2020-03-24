<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\Http\HttpRequest;
use Mvc5\Http\HttpResponse;
use Mvc5\Test\Test\TestCase;
use Mvc5\Web\Layout;
use Mvc5\ViewLayout;
use Mvc5\ViewModel;

use const Mvc5\BODY;

class LayoutTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $layout = new Layout(new ViewLayout);

        $request  = new HttpRequest;
        $response = new HttpResponse([BODY => new ViewModel]);

        $next = fn(HttpRequest $request, HttpResponse $response) => $response;

        $response = $layout($request, $response, $next);

        $this->assertInstanceOf(ViewLayout::class, $response[BODY]);
    }
}
