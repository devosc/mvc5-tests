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
        $messages->add('Hello!', 'info', 'foo');

        $this->assertEmpty($messages->message());
        $this->assertEmpty($messages());
        $this->assertEquals(['message' => 'Hello!', 'type' => 'info'], $messages->message('foo'));
        $this->assertEmpty($messages->message('foo'));
    }

    /**
     *
     */
    function test_serialize()
    {
        $messages = new Messages;
        $messages->add('Hello!');
        $messages->add('Hello!', 'info', 'foo');

        $messages = unserialize(serialize($messages));

        $this->assertEquals(['message' => 'Hello!', 'type' => 'info'], $messages());
        $this->assertEquals(['message' => 'Hello!', 'type' => 'info'], $messages('foo'));
        $this->assertEmpty($messages());
        $this->assertEmpty($messages('foo'));

        $messages->add('Success!', 'success', 'login');

        $messages = unserialize(serialize($messages));

        $this->assertEmpty($messages());
        $this->assertEquals(['message' => 'Success!', 'type' => 'success'], $messages('login'));
        $this->assertEmpty($messages('login'));
    }
}
