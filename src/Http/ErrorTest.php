<?php
/**
 *
 */

namespace Mvc5\Test\Http;

use Mvc5\Arg;
use Mvc5\Http\Error\Error;
use Mvc5\Test\Test\TestCase;

class ErrorTest
    extends TestCase
{
    /**
     *
     */
    function test_code()
    {
        $config = new Error([Arg::CODE => 'foo']);

        $this->assertEquals('foo', $config->code());
    }

    /**
     *
     */
    function test_description()
    {
        $config = new Error([Arg::DESCRIPTION => 'foo']);

        $this->assertEquals('foo', $config->description());
    }

    /**
     *
     */
    function test_errors()
    {
        $config = new Error([Arg::ERRORS => ['foo']]);

        $this->assertEquals(['foo'], $config->errors());
    }

    /**
     *
     */
    function test_message()
    {
        $config = new Error([Arg::MESSAGE => 'foo']);

        $this->assertEquals('foo', $config->message());
    }

    /**
     *
     */
    function test_status()
    {
        $config = new Error([Arg::STATUS => 'foo']);

        $this->assertEquals('foo', $config->status());
    }
}
