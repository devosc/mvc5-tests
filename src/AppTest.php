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
        $config = [
            Arg::SERVICES => [
                Arg::CONTAINER => ['foo']
            ]
        ];

        $app = new App($config);

        $this->assertEquals($config, $app->config());
    }
}
