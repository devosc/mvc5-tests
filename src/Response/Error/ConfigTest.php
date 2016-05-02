<?php
/**
 *
 */

namespace Mvc5\Test\Response\Error;

use Mvc5\Arg;
use Mvc5\Test\Test\TestCase;

class ConfigTest
    extends TestCase
{
    /**
     *
     */
    function test_code()
    {
        $config = new Config([Arg::CODE => 'foo']);

        $this->assertEquals('foo', $config->code());
    }

    /**
     *
     */
    function test_description()
    {
        $config = new Config([Arg::DESCRIPTION => 'foo']);

        $this->assertEquals('foo', $config->description());
    }

    /**
     *
     */
    function test_errors()
    {
        $config = new Config([Arg::ERRORS => ['foo']]);

        $this->assertEquals(['foo'], $config->errors());
    }

    /**
     *
     */
    function test_message()
    {
        $config = new Config([Arg::MESSAGE => 'foo']);

        $this->assertEquals('foo', $config->message());
    }

    /**
     *
     */
    function test_status()
    {
        $config = new Config([Arg::STATUS => 'foo']);

        $this->assertEquals('foo', $config->status());
    }
}
