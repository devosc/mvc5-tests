<?php
/**
 *
 */

namespace Mvc5\Test\Cookie;

use Mvc5\Cookie\Container;
use Mvc5\Cookie\Config as Cookies;
use Mvc5\Test\Test\TestCase;

class CookiesTest
    extends TestCase
{
    /**
     *
     */
    function test_remove()
    {
        $container = new Container;
        $cookies = new Cookies($container);

        $cookies->remove('foo');

        $cookie =  [
            'name'     => 'foo',
            'value'    => false,
            'expire'   => 946706400,
            'path'     => '/',
            'domain'   => '',
            'secure'   => false,
            'httponly' => true
        ];

        $this->assertEquals($cookie, $container['foo']);
    }

    /**
     *
     */
    function test_set()
    {
        $cookies = new Cookies(new Container);

        $cookies->set('foo', 'bar');

        $this->assertEquals('bar', $cookies->set('foo', 'bar'));
    }

    /**
     *
     */
    function test_value()
    {
        $cookies = new Cookies(new Container, ['foo' => 'bar']);

        $this->assertEquals('bar', $cookies['foo']);
    }
}
