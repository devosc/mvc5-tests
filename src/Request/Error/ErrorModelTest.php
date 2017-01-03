<?php
/**
 *
 */

namespace Mvc5\Test\Request\Error;

use Mvc5\Arg;
use Mvc5\Request\Error\Model;
use Mvc5\Test\Test\TestCase;

class ErrorModelTest
    extends TestCase
{
    /**
     *
     */
    function test_code()
    {
        $model = new Model(null, [Arg::ERROR => [Arg::CODE => 'foo']]);

        $this->assertEquals('foo', $model->code());
    }

    /**
     *
     */
    function test_errors()
    {
        $model = new Model(null, [Arg::ERROR => [Arg::ERRORS => []]]);

        $this->assertEquals([], $model->errors());
    }

    /**
     *
     */
    function test_message()
    {
        $model = new Model(null, [Arg::ERROR => [Arg::MESSAGE => 'foo']]);

        $this->assertEquals('foo', $model->message());
    }
}
