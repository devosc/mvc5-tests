<?php
/**
 *
 */

namespace Mvc5\Test\Cookie\Config;

use Mvc5\Test\Test\TestCase;

class ContainerTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $cookies = new Container(['expire' => 1]);

        $this->assertEquals(['expire' => 1] + $cookies->defaults(), $cookies->defaults());
    }

    /**
     *
     */
    function test_cookie()
    {
        $cookies = new Container;

        $cookie = $cookies->cookie('foo', 'bar', null, null, null, null, null);

        $this->assertEquals(['name' => 'foo', 'value' => 'bar'] + $cookies->defaults(), $cookie);
    }

    /**
     *
     */
    function test_remove()
    {
        $cookies = new Container;

        $cookies->remove('foo');

        $cookie = $cookies->config()['foo'];

        $this->assertEquals(['name' => 'foo', 'value' => false, 'expire' => 946706400] + $cookies->defaults(), $cookie);
    }

    /**
     *
     */
    function test_set()
    {
        $cookies = new Container;

        $cookies->set('foo', 'bar');

        $cookie = $cookies->config()['foo'];

        $this->assertEquals(['name' => 'foo', 'value' => 'bar'] + $cookies->defaults(), $cookie);
    }

    /**
     *
     */
    function test_store()
    {
        $cookies = new Container;

        $cookies->setCookie('foo', 'bar', null, null, null, null, null);

        $cookie = $cookies->config()['foo'];

        $this->assertEquals(['name' => 'foo', 'value' => 'bar'] + $cookies->defaults(), $cookie);
    }
}
