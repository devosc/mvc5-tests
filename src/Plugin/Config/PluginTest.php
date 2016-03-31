<?php
/**
 *
 */

namespace Mvc5\Test\Plugin\Config;

use Mvc5\Arg;
use Mvc5\Test\Test\TestCase;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    public function test_args()
    {
        $plugin = new Plugin([Arg::ARGS => 'foo']);

        $this->assertEquals('foo', $plugin->args());
    }

    /**
     *
     */
    public function test_args_not_exist()
    {
        $plugin = new Plugin;

        $this->assertEquals([], $plugin->args());
    }

    /**
     *
     */
    public function test_calls()
    {
        $plugin = new Plugin([Arg::CALLS => 'foo']);

        $this->assertEquals('foo', $plugin->calls());
    }

    /**
     *
     */
    public function test_calls_not_exist()
    {
        $plugin = new Plugin;

        $this->assertEquals([], $plugin->calls());
    }

    /**
     *
     */
    public function test_merge()
    {
        $plugin = new Plugin([Arg::MERGE => true]);

        $this->assertEquals(true, $plugin->merge());
    }

    /**
     *
     */
    public function test_merge_not_exist()
    {
        $plugin = new Plugin();

        $this->assertEquals(false, $plugin->merge());
    }

    /**
     *
     */
    public function test_name()
    {
        $plugin = new Plugin([Arg::NAME => 'foo']);

        $this->assertEquals('foo', $plugin->name());
    }

    /**
     *
     */
    public function test_param()
    {
        $plugin = new Plugin([Arg::PARAM => 'foo']);

        $this->assertEquals('foo', $plugin->param());
    }

    /**
     *
     */
    public function test_param_not_exist()
    {
        $plugin = new Plugin;

        $this->assertEquals(null, $plugin->param());
    }
}
