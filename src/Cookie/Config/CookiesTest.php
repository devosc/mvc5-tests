<?php
/**
 *
 */

namespace Mvc5\Test\Cookie\Config;

use Mvc5\Test\Test\TestCase;

class CookiesTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $cookies = new Cookies(new Container, ['foo']);

        $this->assertEquals(new Container, $cookies->container());
        $this->assertEquals(['foo'],       $cookies->config());
    }

    /**
     *
     */
    function test_remove()
    {
        $cookies = new Cookies(new Container);

        $cookies->remove('foo');

        $cookie = $cookies->container()['foo'];

        $this->assertEquals(['name' => 'foo', 'value' => false, 'expire' => 946706400] + $cookies->defaults(), $cookie);
    }

    /**
     *
     */
    function test_set()
    {
        $cookies = new Cookies(new Container);

        $cookies->set('foo', 'bar');

        $cookie = $cookies->container()['foo'];

        $this->assertEquals(['name' => 'foo', 'value' => 'bar'] + $cookies->defaults(), $cookie);
    }
}
