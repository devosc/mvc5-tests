<?php
/**
 *
 */

namespace Mvc5\Test\Http;

use Mvc5\Arg;
use Mvc5\Http\HttpError;
use Mvc5\Test\Test\TestCase;

class ErrorTest
    extends TestCase
{
    /**
     *
     */
    function test_code()
    {
        $config = new HttpError([Arg::CODE => 500]);

        $this->assertEquals(500, $config->code());
    }

    /**
     *
     */
    function test_description()
    {
        $config = new HttpError([Arg::DESCRIPTION => 'foo']);

        $this->assertEquals('foo', $config->description());
    }

    /**
     *
     */
    function test_errors()
    {
        $config = new HttpError([Arg::ERRORS => ['foo']]);

        $this->assertEquals(['foo'], $config->errors());
    }

    /**
     *
     */
    function test_message()
    {
        $config = new HttpError([Arg::MESSAGE => 'foo']);

        $this->assertEquals('foo', $config->message());
    }

    /**
     *
     */
    function test_status()
    {
        $config = new HttpError([Arg::STATUS => 500]);

        $this->assertEquals(500, $config->status());
    }
}
