<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Arg;
use Mvc5\App;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class __callTest
    extends TestCase
{
    /**
     *
     */
    public function test__call()
    {
        /** @var Resolver|Mock $mock */

        $app = new App([
            Arg::SERVICES => [
                'foo' => new App([
                    Arg::SERVICES => [
                        'bar' => new App([
                            Arg::SERVICES => [
                                'baz' => function() {
                                    return new class() {
                                        function test($foo) {
                                            return $foo;
                                        }
                                    };
                                }
                            ]
                        ])
                    ]
                ])
            ]
        ]);

        $name = 'foo->bar->baz.test';

        $this->assertEquals('foobar', $app->$name('foobar'));

        $this->assertEquals('foobar', $app->call($name, ['foo' => 'foobar']));

        $this->assertEquals('foobar', call_user_func_array([$app, $name], ['foobar']));
    }
}
