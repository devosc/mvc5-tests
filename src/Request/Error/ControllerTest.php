<?php
/**
 *
 */

namespace Mvc5\Test\Request\Error;

use Mvc5\App;
use Mvc5\Http\Error\NotFound;
use Mvc5\Http\HttpRequest;
use Mvc5\Request\Error\Controller;
use Mvc5\Request\Error\ErrorModel;
use Mvc5\Request\Error\ViewModel;
use Mvc5\Response\JsonErrorResponse;
use Mvc5\Test\Test\TestCase;

use const Mvc5\{ ERROR_MODEL, RESPONSE_JSON_ERROR };

/**
 *
 */
class ControllerTest
    extends TestCase
{
    /**
     * @throws \Throwable
     */
    function test_json_error_response()
    {
        $config = ['services' => [RESPONSE_JSON_ERROR => JsonErrorResponse::class]];

        $request = new HttpRequest(['accepts_json' => true, 'error' => new NotFound]);

        $response = (new Controller(new App($config)))($request);

        $this->assertInstanceOf(JsonErrorResponse::class, $response);
        $this->assertEquals(404, $response->status());
    }

    /**
     * @throws \Throwable
     */
    function test_view_error_model()
    {
        $config = ['services' => [ERROR_MODEL => ViewModel::class]];

        $model = (new Controller(new App($config)))(new HttpRequest(['error' => new NotFound]));

        $this->assertInstanceOf(ErrorModel::class, $model);
        $this->assertInstanceOf(NotFound::class, $model['error']);
    }
}
