<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Arg;
use Mvc5\App;
use Mvc5\Event;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class InvokableTest
    extends TestCase
{
    /**
     *
     */
    public function test_invokable_event()
    {
        /** @var Resolver|Mock $mock */

        $app = new App([
            Arg::EVENTS => [
                'foo' => [
                    function() {
                        return 'bar';
                    }
                ]
            ],
            Arg::SERVICES => [
                Arg::EVENT_MODEL => Event::class
            ]
        ]);

        $this->assertEquals('bar', $app->call('foo'));
    }

    /**
     *
     */
    public function test_invokable_string()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['invokable', 'invokableTest']);

        $this->assertEquals('foo', $mock->invokableTest('@foo'));
    }
}
