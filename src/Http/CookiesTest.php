<?php
/**
 *
 */

namespace Mvc5\Test\Http;

use Mvc5\Http\HttpCookies;
use Mvc5\Test\Test\TestCase;

class CookiesTest
    extends TestCase
{
    /**
     *
     */
    function test_with()
    {
        $cookies = new HttpCookies;

        $new = $cookies->withCookie('foo', 'bar');

        $this->assertNotEquals($cookies, $new);

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

        $new = $cookies->withoutCookie('foo');

        $this->assertNotEquals($cookies, $new);
        $this->assertEquals('bar', $cookies['foo']);

        $cookie = [
            'name' => 'foo',
            'value' => false,
            'expire' => 946706400,
            'path' => '/',
            'domain' => '',
            'secure' => false,
            'httponly' => true
        ];

        $this->assertEquals($cookie, $new['foo']);
    }
}
