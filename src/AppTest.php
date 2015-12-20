<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\Arg;
use Mvc5\App;
use Mvc5\Test\Test\TestCase;

class AppTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        /** @var App $mock */

        $config = [
            Arg::SERVICES => [
                Arg::CONTAINER => ['foo']
            ]
        ];

        $mock = $this->getCleanMock(App::class, ['config'], [$config]);

        $this->assertEquals($config, $mock->config());
    }
}
