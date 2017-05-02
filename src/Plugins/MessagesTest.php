<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\App;
use Mvc5\Session\Messages;
use Mvc5\Test\Test\TestCase;

class MessagesTest
    extends TestCase
{
    /**
     *
     */
    function test_danger()
    {
        $messages = new Messages;

        $app = new App(['services' => ['session\messages' => $messages]]);

        $plugin = new MessagesPlugin($app);

        $plugin->danger('Hello!');

        $this->assertEquals(['message' => 'Hello!', 'type' => 'danger'], $messages());
    }

    /**
     *
     */
    function test_info()
    {
        $messages = new Messages;

        $app = new App(['services' => ['session\messages' => $messages]]);

        $plugin = new MessagesPlugin($app);

        $plugin->info('Hello!');

        $this->assertEquals(['message' => 'Hello!', 'type' => 'info'], $messages());
    }

    /**
     *
     */
    function test_message()
    {
        $messages = new Messages;

        $app = new App(['services' => ['session\messages' => $messages]]);

        $plugin = new MessagesPlugin($app);

        $plugin->info('Hello!');

        $this->assertEquals(['message' => 'Hello!', 'type' => 'info'], $plugin->message());
    }

    /**
     *
     */
    function test_messages()
    {
        $messages = new Messages;

        $app = new App(['services' => ['session\messages' => $messages]]);

        $plugin = new MessagesPlugin($app);

        $this->assertEquals($messages, $plugin->messages());
    }

    /**
     *
     */
    function test_success()
    {
        $messages = new Messages;

        $app = new App(['services' => ['session\messages' => $messages]]);

        $plugin = new MessagesPlugin($app);

        $plugin->success('Hello!');

        $this->assertEquals(['message' => 'Hello!', 'type' => 'success'], $messages());
    }

    /**
     *
     */
    function test_warning()
    {
        $messages = new Messages;

        $app = new App(['services' => ['session\messages' => $messages]]);

        $plugin = new MessagesPlugin($app);

        $plugin->warning('Hello!');

        $this->assertEquals(['message' => 'Hello!', 'type' => 'warning'], $messages());
    }
}
