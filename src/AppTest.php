<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\App;
use Mvc5\Arg;
use Mvc5\Test\Test\TestCase;

class AppTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $config = [
            Arg::ALIAS => [],
            Arg::EVENTS => [],
            Arg::SERVICES => [
                Arg::CONTAINER => []
            ],
        ];

        /** @var App $mock */

        $mock = $this->getCleanMock(App::class, ['config'], [$config]);

        $this->assertEquals($config, $mock->config());
    }
}
