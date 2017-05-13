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
        $config = new HttpError([Arg::CODE => 'foo']);

        $this->assertEquals('foo', $config->code());
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
        $config = new HttpError([Arg::STATUS => 'foo']);

        $this->assertEquals('foo', $config->status());
    }
}
