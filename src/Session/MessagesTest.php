<?php
/**
 *
 */

namespace Mvc5\Test\Session;

use Mvc5\Session\Messages;
use Mvc5\Test\Test\TestCase;

class MessagesTest
    extends TestCase
{
    /**
     *
     */
    function test_no_messages()
    {
        $messages = new Messages;
        $this->assertEmpty($messages());
    }

    /**
     *
     */
    function test_message()
    {
        $messages = new Messages;
        $messages->flash('Hello!', 'info', 'foo');

        $this->assertEmpty($messages->message());
        $this->assertEmpty($messages());
        $this->assertEquals(['message' => 'Hello!', 'type' => 'info'], $messages->message('foo'));
        $this->assertEmpty($messages->message('foo'));
    }

    /**
     *
     */
    function test_named_message()
    {
        $messages = new Messages;
        $messages->flash('Hello!', 'info', 'foo');

        $this->assertEmpty($messages->message());
        $this->assertEmpty($messages());
        $this->assertEquals(['message' => 'Hello!', 'type' => 'info'], $messages('foo'));
        $this->assertEmpty($messages('foo'));
    }
}
