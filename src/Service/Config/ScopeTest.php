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
}
