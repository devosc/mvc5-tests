<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\Arg;
use Mvc5\Http\HttpRequest;
use Mvc5\Http\HttpResponse;
use Mvc5\Test\Test\TestCase;
use Mvc5\Web\Layout;
use Mvc5\ViewLayout;
use Mvc5\ViewModel;

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
        $response = new HttpResponse([Arg::BODY => new ViewModel]);

        $next = function(HttpRequest $request, HttpResponse $response) {
            return $response;
        };

        $response = $layout($request, $response, $next);

        $this->assertInstanceOf(ViewLayout::class, $response[Arg::BODY]);
    }
}
