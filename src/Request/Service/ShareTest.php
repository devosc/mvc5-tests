<?php
/**
 *
 */

namespace Mvc5\Test\Request\Service;

use Mvc5\Arg;
use Mvc5\Config;
use Mvc5\Http\Request\Config as Request;
use Mvc5\Request\Service\Share;
use Mvc5\Test\Test\TestCase;

class ShareTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $config = new Config;

        $service = new Share($config);

        $service(new Request);

        $this->assertInstanceOf(Request::class, $config[Arg::REQUEST]);
    }
}
