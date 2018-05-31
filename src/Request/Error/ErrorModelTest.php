<?php
/**
 *
 */

namespace Mvc5\Test\Request\Error;

use Mvc5\Arg;
use Mvc5\Http\HttpError;
use Mvc5\Request\Error\ViewModel;
use Mvc5\Test\Test\TestCase;

class ErrorModelTest
    extends TestCase
{
    /**
     *
     */
    function test_code()
    {
        $model = new ViewModel(new HttpError([Arg::CODE => 500]));

        $this->assertEquals(500, $model->code());
    }

    /**
     *
     */
    function test_errors()
    {
        $model = new ViewModel(new HttpError([Arg::ERRORS => []]));

        $this->assertEquals([], $model->errors());
    }

    /**
     *
     */
    function test_message()
    {
        $model = new ViewModel(new HttpError([Arg::MESSAGE => 'foo']));

        $this->assertEquals('foo', $model->message());
    }
}
