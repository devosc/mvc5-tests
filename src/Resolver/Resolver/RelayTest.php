<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Arg;
use Mvc5\App;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class RelayTest
    extends TestCase
{
    /**
     *
     */
    public function test_relay_no_config()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['relay', 'relayTest']);

        $mock->expects($this->once())
            ->method('invoke')
            ->willReturn('bar');

        $this->assertEquals('bar', $mock->relayTest('foo'));
    }

    /**
     *
     */
    public function atest_relay_config()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['relay', 'relayTest']);

        $mock->expects($this->any())
            ->method('invoke')
            ->will($this->onConsecutiveCalls('bar', 'baz'));

        $this->assertEquals('baz', $mock->relayTest('foo', ['bar', 'baz']));
    }

    /**
     *
     */
    public function test_relay()
    {
        /** @var Resolver|Mock $mock */

        $app = new App([
            Arg::SERVICES => [
                'foo' => new class() {
                    function bar() {
                        return new class() {
                            function baz($foo) {
                                return $foo;
                            }
                        };
                    }
                }
            ]
        ]);

        $name = 'foo.bar.baz';

        $this->assertEquals('foobar', $app->call($name, ['foobar']));
    }
}
