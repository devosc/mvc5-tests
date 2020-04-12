<?php
/**
 *
 */

namespace Mvc5\Test\Http;

use Mvc5\Http\HttpError;
use Mvc5\Test\Test\TestCase;

use const Mvc5\{ CODE, DESCRIPTION, ERRORS, MESSAGE, STATUS };

final class ErrorTest
    extends TestCase
{
    /**
     *
     */
    function test_code()
    {
        $config = new HttpError([CODE => 500]);

        $this->assertEquals(500, $config->code());
    }

    /**
     *
     */
    function test_description()
    {
        $config = new HttpError([DESCRIPTION => 'foo']);

        $this->assertEquals('foo', $config->description());
    }

    /**
     *
     */
    function test_errors()
    {
        $config = new HttpError([ERRORS => ['foo']]);

        $this->assertEquals(['foo'], $config->errors());
    }

    /**
     *
     */
    function test_message()
    {
        $config = new HttpError([MESSAGE => 'foo']);

        $this->assertEquals('foo', $config->message());
    }

    /**
     *
     */
    function test_status()
    {
        $config = new HttpError([STATUS => 500]);

        $this->assertEquals(500, $config->status());
    }
}
