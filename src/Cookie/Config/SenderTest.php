<?php
/**
 *
 */

namespace Mvc5\Test\Cookie\Config;

use Mvc5\Config;
use Mvc5\Test\Test\TestCase;

class SenderTest
    extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    function test_set_cookie()
    {
        $cookies = new Sender;

        $this->assertTrue($cookies->setCookie('foo', 'bar', null, null, null, null, null));
    }
}
