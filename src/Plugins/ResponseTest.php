<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\App;
use Mvc5\Response\HttpResponse;
use Mvc5\Response\JsonResponse;
use Mvc5\Response\RedirectResponse;
use Mvc5\Test\Test\TestCase;

final class ResponseTest
    extends TestCase
{
    /**
     *
     */
    function test_json()
    {
        $config = ['services' => ['response\json' => JsonResponse::class]];

        $plugin = new ResponsePlugin(new App($config));

        $this->assertInstanceOf(JsonResponse::class, $plugin->json(['foo']));
    }

    /**
     *
     */
    function test_redirect()
    {
        $config = ['services' => ['response\redirect' => RedirectResponse::class]];

        $plugin = new ResponsePlugin(new App($config));

        $this->assertInstanceOf(RedirectResponse::class, $plugin->redirect('/'));
    }

    /**
     *
     */
    function test_response()
    {
        $config = ['services' => ['response' => HttpResponse::class]];

        $plugin = new ResponsePlugin(new App($config));

        $this->assertInstanceOf(HttpResponse::class, $plugin->response('foo'));
    }
}
