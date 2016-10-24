<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\App;
use Mvc5\Response\Json;
use Mvc5\Response\Redirect;
use Mvc5\Response\Config as Response;
use Mvc5\Test\Test\TestCase;

class ResponseTest
    extends TestCase
{
    /**
     *
     */
    function test_json()
    {
        $config = ['services' => ['response\json' => Json::class]];

        $plugin = new ResponsePlugin;
        $plugin->service(new App($config));

        $this->assertInstanceOf(Json::class, $plugin->json(['foo']));
    }

    /**
     *
     */
    function test_redirect()
    {
        $config = ['services' => ['response\redirect' => Redirect::class]];

        $plugin = new ResponsePlugin;
        $plugin->service(new App($config));

        $this->assertInstanceOf(Redirect::class, $plugin->redirect('/'));
    }

    /**
     *
     */
    function test_response()
    {
        $config = ['services' => ['response' => Response::class]];

        $plugin = new ResponsePlugin;
        $plugin->service(new App($config));

        $this->assertInstanceOf(Response::class, $plugin->response('foo'));
    }
}
