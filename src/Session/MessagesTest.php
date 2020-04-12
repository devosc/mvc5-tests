<?php
/**
 *
 */

namespace Mvc5\Test\Session;

use Mvc5\Session\Messages;
use Mvc5\Test\Test\TestCase;

final class MessagesTest
    extends TestCase
{
    /**
     *
     */
    function test_custom_type()
    {
        $messages = new Messages(['danger' => 'alert']);

        $messages->danger('Danger!');

        $this->assertEquals(['message' => 'Danger!', 'type' => 'alert'], $messages->message());
    }

    /**
     *
     */
    function test_danger()
    {
        $messages = new Messages;
        $messages->danger('Danger!');

        $this->assertEquals(['message' => 'Danger!', 'type' => 'danger'], $messages->message());
    }

    /**
     *
     */
    function test_info()
    {
        $messages = new Messages;
        $messages->info('Info!');

        $this->assertEquals(['message' => 'Info!', 'type' => 'info'], $messages->message());
    }

    /**
     *
     */
    function test_message()
    {
        $messages = new Messages;
        $messages->info('Info!', 'foo');

        $this->assertEmpty($messages->message());
        $this->assertEmpty($messages());
        $this->assertEquals(['message' => 'Info!', 'type' => 'info'], $messages->message('foo'));
        $this->assertEmpty($messages->message('foo'));
    }

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
    function test_remove_array()
    {
        $messages = new Messages;

        $messages->set([
            'foo' => ['message' => 'bar', 'type' => 'success'],
            'baz' => ['message' => 'bat', 'type' => 'info']
        ]);

        $this->assertTrue($messages->has('foo'));
        $this->assertTrue($messages->has('baz'));

        $messages->remove(['foo', 'baz']);

        $this->assertFalse($messages->has('foo'));
        $this->assertFalse($messages->has('baz'));
    }

    /**
     *
     */
    function test_serialize()
    {
        $messages = new Messages;
        $messages->info('Info!');
        $messages->info('Info!', 'foo');

        $messages = unserialize(serialize($messages));

        $this->assertEquals(['message' => 'Info!', 'type' => 'info'], $messages());
        $this->assertEquals(['message' => 'Info!', 'type' => 'info'], $messages('foo'));
        $this->assertEmpty($messages());
        $this->assertEmpty($messages('foo'));

        $messages->success('Success!', 'login');

        $messages = unserialize(serialize($messages));

        $this->assertEmpty($messages());
        $this->assertEquals(['message' => 'Success!', 'type' => 'success'], $messages('login'));
        $this->assertEmpty($messages('login'));
    }

    /**
     *
     */
    function test_set_array()
    {
        $messages = new Messages;

        $messages->set([
            'foo' => ['message' => 'bar', 'type' => 'success'],
            'baz' => ['message' => 'bat', 'type' => 'info']
        ]);

        $this->assertEquals(['message' => 'bar', 'type' => 'success'], $messages('foo'));
        $this->assertEquals(['message' => 'bat', 'type' => 'info'], $messages('baz'));
    }

    /**
     *
     */
    function test_success()
    {
        $messages = new Messages;
        $messages->success('Success!');

        $this->assertEquals(['message' => 'Success!', 'type' => 'success'], $messages->message());
    }

    /**
     *
     */
    function test_warning()
    {
        $messages = new Messages;
        $messages->warning('Warning!');

        $this->assertEquals(['message' => 'Warning!', 'type' => 'warning'], $messages->message());
    }
}
