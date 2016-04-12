<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Plugin;
use Mvc5\Test\Test\TestCase;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $plugin = new Plugin('foo');

        $this->assertEquals('foo',  $plugin->name());
        $this->assertEquals([],     $plugin->args());
        $this->assertEquals([],     $plugin->calls());
        $this->assertEquals('item', $plugin->param());
        $this->assertEquals(false,  $plugin->merge());
    }

    /**
     *
     */
    public function test_construct_false_param()
    {
        $plugin = new Plugin('foo', [], [], null);

        $this->assertEquals('item', $plugin->param());
    }

    /**
     *
     */
    public function test_construct_with_param()
    {
        $plugin = new Plugin('foo', [], [], 'bar');

        $this->assertEquals('bar', $plugin->param());
    }

    /**
     *
     */
    public function test_construct_with_merge()
    {
        $plugin = new Plugin('foo', [], [], null, true);

        $this->assertEquals(true, $plugin->merge());
    }
}
