<?php
/**
 *
 */

namespace Mvc5\Test\Cookie;

use Mvc5\Cookie\HttpCookies;
use Mvc5\Test\Test\TestCase;

class HttpCookiesTest
    extends TestCase
{
    /**
     *
     */
    function test_all()
    {
        $cookies = new HttpCookies(['foo' => 'bar']);

        $this->assertEquals(['foo' => 'bar'], $cookies->all());
    }

    /**
     *
     */
    function test_with()
    {
        $cookies = new HttpCookies;

        $new = $cookies->with('foo', 'bar');

        $this->assertNotSame($cookies, $new);

        $cookie = [
            'name' => 'foo',
            'value' => 'bar',
            'expire' => 0,
            'path' => '/',
            'domain' => '',
            'secure' => false,
            'httponly' => true
        ];

        $this->assertEquals($cookie, $new['foo']);
    }

    /**
     *
     */
    function test_without()
    {
        $cookies = new HttpCookies(['foo' => 'bar']);

        $new = $cookies->without('foo');

        $this->assertNotEquals($cookies, $new);
        $this->assertEquals('bar', $cookies['foo']);

        $cookie = [
            'name' => 'foo',
            'value' => '',
            'expire' => 946706400,
            'path' => '/',
            'domain' => '',
            'secure' => false,
            'httponly' => true
        ];

        $this->assertEquals($cookie, $new['foo']);
    }
}
