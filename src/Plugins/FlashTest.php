<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\App;
use Mvc5\Plugin\Dependency;
use Mvc5\Session\Messages;
use Mvc5\Test\Test\TestCase;

class FlashTest
    extends TestCase
{
    /**
     *
     */
    function test_message()
    {
        $app = new App(['services' => ['flash\messages' => new Dependency('flash\messages', Messages::class)]]);

        $plugin = new FlashPlugin;
        $plugin->service($app);

        $plugin->flash('Hello!', 'info');

        $this->assertEquals(['message' => 'Hello!', 'type' => 'info'], $app['flash\messages']());
    }

    /**
     *
     */
    function test_message_serialized()
    {
        $app = new App(['services' => ['flash\messages' => new Dependency('flash\messages', Messages::class)]]);

        $plugin = new FlashPlugin;
        $plugin->service($app);

        $plugin->flash('Hello!', 'info');

        $app['flash\messages'] = unserialize(serialize($app['flash\messages']));

        $this->assertEquals(['message' => 'Hello!', 'type' => 'info'], $app['flash\messages']());
    }

    /**
     *
     */
    function test_message_named()
    {
        $app = new App(['services' => ['flash\messages' => new Dependency('flash\messages', Messages::class)]]);

        $plugin = new FlashPlugin;
        $plugin->service($app);

        $plugin->flash('Hello!', 'info', 'foo');

        $app['flash\messages'] = unserialize(serialize($app['flash\messages']));

        $this->assertEquals(['message' => 'Hello!', 'type' => 'info'], $app['flash\messages']('foo'));
    }
}
