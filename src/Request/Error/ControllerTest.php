<?php
/**
 *
 */

namespace Mvc5\Test\Request\Error;

use Mvc5\App;
use Mvc5\Arg;
use Mvc5\Http\Error\NotFound;
use Mvc5\Http\HttpRequest;
use Mvc5\Request\Error\Controller;
use Mvc5\Request\Error\ErrorModel;
use Mvc5\Request\Error\ViewModel;
use Mvc5\Response\JsonErrorResponse;
use Mvc5\Test\Test\TestCase;

/**
 *
 */
class ControllerTest
    extends TestCase
{
    /**
     *
     */
    function test_json_error_response()
    {
        $config = ['services' => [Arg::RESPONSE_JSON_ERROR => JsonErrorResponse::class]];

        $request = new HttpRequest(['accepts_json' => true, 'error' => new NotFound]);

        $response = (new Controller(new App($config)))($request);

        $this->assertInstanceOf(JsonErrorResponse::class, $response);
        $this->assertEquals(404, $response->status());
    }

    /**
     *
     */
    function test_view_error_model()
    {
        $config = ['services' => [Arg::ERROR_MODEL => ViewModel::class]];

        $model = (new Controller(new App($config)))(new HttpRequest(['error' => new NotFound]));

        $this->assertInstanceOf(ErrorModel::class, $model);
        $this->assertInstanceOf(NotFound::class, $model['error']);
    }
}
