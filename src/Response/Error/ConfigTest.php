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
    public function test_code()
    {
        $config = new Config([Arg::CODE => 'foo']);

        $this->assertEquals('foo', $config->code());
    }

    /**
     *
     */
    public function test_description()
    {
        $config = new Config([Arg::DESCRIPTION => 'foo']);

        $this->assertEquals('foo', $config->description());
    }

    /**
     *
     */
    public function test_errors()
    {
        $config = new Config([Arg::ERRORS => ['foo']]);

        $this->assertEquals(['foo'], $config->errors());
    }

    /**
     *
     */
    public function test_message()
    {
        $config = new Config([Arg::MESSAGE => 'foo']);

        $this->assertEquals('foo', $config->message());
    }

    /**
     *
     */
    public function test_status()
    {
        $config = new Config([Arg::STATUS => 'foo']);

        $this->assertEquals('foo', $config->status());
    }
}
