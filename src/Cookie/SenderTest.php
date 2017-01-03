<?php
/**
 *
 */

namespace Mvc5\Test\Cookie;

use Mvc5\Cookie\Sender;
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

        $this->assertEquals('bar', $cookies->set('foo', 'bar', null, null, null, null, null));
    }
}
