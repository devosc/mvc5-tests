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
    public function test_construct()
    {
        $this->assertInstanceOf(Web::class, new Web);
    }

    /**
     *
     */
    public function test_invoke()
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
    public function test_invoke_exception()
    {
        $config = [
            Arg::SERVICES => [
                Arg::WEB => function() {
                    return function() {
                        throw new \Exception;
                    };
                },
                Arg::RESPONSE_EXCEPTION => function() {
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
