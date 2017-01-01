<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\Arg;
use Mvc5\Web;
use Mvc5\Test\Test\TestCase;

class WebTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $config = [
            Arg::SERVICES => [
                Arg::WEB => function() {
                    return function() {
                        return 'foo';
                    };
                }
            ]
        ];

        $web = new Web($config);

        $this->assertEquals('foo', $web());
    }

    /**
     *
     */
    function test_exception()
    {
        $config = [
            Arg::SERVICES => [
                Arg::WEB => function() {
                    return function() {
                        throw new \Exception;
                    };
                },
                Arg::EXCEPTION_RESPONSE => function() {
                    return function() {
                        return 'foo';
                    };
                }
            ]
        ];

        $web = new Web($config);

        $this->assertEquals('foo', $web());
    }
}
