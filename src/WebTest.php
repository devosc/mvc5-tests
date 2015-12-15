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
        /** @var Web $mock */

        $mock = $this->getCleanMock(Web::class, [], []);

        $this->assertInstanceOf(Web::class, $mock);
    }

    /**
     *
     */
    public function test_invoke()
    {
        $config = [
            Arg::ALIAS => [
                Arg::WEB => function() {
                    return 'foo';
                }
            ]
        ];
        /** @var Web $mock */

        $mock = $this->getCleanMock(Web::class, ['__invoke'], [$config]);

        $this->assertEquals('foo', $mock->__invoke());
    }

    /**
     *
     */
    public function test_invoke_exception()
    {
        $config = [
            Arg::ALIAS => [
                Arg::WEB => function() {
                    throw new \Exception;
                },
                Arg::RESPONSE_EXCEPTION => function() {
                    return 'foo';
                }
            ]
        ];

        /** @var Web $mock */

        $mock = $this->getCleanMock(Web::class, ['__invoke'], [$config]);

        $this->assertEquals('foo', $mock->__invoke());
    }
}
