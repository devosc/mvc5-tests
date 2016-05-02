<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Arg;
use Mvc5\App;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class RelayTest
    extends TestCase
{
    /**
     *
     */
    function test_relay_no_config()
    {
        $resolver = new Resolver;

        $this->assertEquals(phpversion(), $resolver->relay('phpversion'));
    }

    /**
     *
     */
    function test_relay_config()
    {
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
