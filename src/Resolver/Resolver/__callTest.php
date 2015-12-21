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
                        'bar' => function() {
                            return function($foo) {
                                return $foo;
                            };
                        }
                    ]
                ])
            ]
        ]);

        $bar = 'foo.bar';

        $this->assertEquals('baz', $app->$bar('baz'));
    }
}
