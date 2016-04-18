<?php
/**
 *
 */

namespace Mvc5\Test\Service\Config;

use Mvc5\Config;
use Mvc5\Plugins;
use Mvc5\Test\Test\TestCase;

class ScopeTest
    extends TestCase
{
    /**
     *
     */
    public function test_clone_not_object()
    {
        $config = new Scope;

        $this->assertEquals(clone $config, $config);
    }

    /**
     *
     */
    public function test_clone_object_not_scoped()
    {
        $config = new Scope(new Config);

        $this->assertEquals(clone $config, $config);
    }

    /**
     *
     */
    public function test_clone_object_scoped()
    {
        $plugins = new Plugins;

        $config = new Scope($plugins);

        $plugins->scope($config);

        $this->assertEquals(clone $config, $config);
    }

    /**
     *
     */
    public function test_clone_object_scoped_true()
    {
        $plugins = new Plugins(null, null, true);

        $config = new Scope($plugins);

        $this->assertEquals(clone $config, $config);
    }

    /**
     *
     */
    public function test_clone_object_scoped_different_object()
    {
        $plugins = new Plugins;

        $config = new Scope($plugins);

        $plugins->scope(new \stdClass);

        $this->assertEquals(clone $config, $config);
    }
}
