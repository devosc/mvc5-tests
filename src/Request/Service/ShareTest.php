<?php
/**
 *
 */

namespace Mvc5\Test\Request\Service;

use Mvc5\Config;
use Mvc5\Http\HttpRequest;
use Mvc5\Request\Service\Share;
use Mvc5\Test\Test\TestCase;

use const Mvc5\REQUEST;

final class ShareTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $config = new Config;

        $service = new Share($config);

        $service(new HttpRequest);

        $this->assertInstanceOf(HttpRequest::class, $config[REQUEST]);
    }
}
