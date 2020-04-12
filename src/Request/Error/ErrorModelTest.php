<?php
/**
 *
 */

namespace Mvc5\Test\Request\Error;

use Mvc5\Http\HttpError;
use Mvc5\Request\Error\ViewModel;
use Mvc5\Test\Test\TestCase;

use const Mvc5\{ CODE, ERRORS, MESSAGE};

final class ErrorModelTest
    extends TestCase
{
    /**
     *
     */
    function test_code()
    {
        $model = new ViewModel(new HttpError([CODE => 500]));

        $this->assertEquals(500, $model->code());
    }

    /**
     *
     */
    function test_errors()
    {
        $model = new ViewModel(new HttpError([ERRORS => []]));

        $this->assertEquals([], $model->errors());
    }

    /**
     *
     */
    function test_message()
    {
        $model = new ViewModel(new HttpError([MESSAGE => 'foo']));

        $this->assertEquals('foo', $model->message());
    }
}
