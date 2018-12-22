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
        $baz = ['baz', 'bat'];
        $foo = ['name' => 'foo', 'value' => 'foobar'];
        $config = ['baz' => $baz, 'foo' => $foo];

        $cookies = (new HttpCookies($config))->all();
        $this->assertEquals($config, $cookies);
        $this->assertEquals($baz, $cookies['baz']);
        $this->assertEquals($foo, $cookies['foo']);
    }

    /**
     *
     */
    function test_with()
    {
        $cookies = new HttpCookies;

        $new = $cookies->with('foo', 'bar');

        $this->assertNotSame($cookies, $new);

        $cookie = ['name' => 'foo', 'value' => 'bar'];

        $this->assertEquals($cookie, $new['foo']);
    }

    /**
     *
     */
    function test_with_array()
    {
        $cookies = new HttpCookies;

        $new = $cookies->with(['foo', 'bar']);

        $this->assertNotSame($cookies, $new);

        $cookie = [
            'name' => 'foo', 'value' => 'bar', 'expires' => null, 'path' => null, 'domain' => null,
            'secure' => null, 'httponly' => null, 'samesite' => null
        ];

        $this->assertEquals($cookie, $new['foo']);
    }

    /**
     *
     */
    function test_with_associative_array()
    {
        $cookies = new HttpCookies;

        $new = $cookies->with(['name' => 'foo', 'value' => 'bar']);

        $this->assertNotSame($cookies, $new);

        $cookie = ['name' => 'foo', 'value' => 'bar'];

        $this->assertEquals($cookie, $new['foo']);
    }

    /**
     *
     */
    function test_with_raw()
    {
        $cookies = new HttpCookies;

        $new = $cookies->with(['name' => 'foo', 'value' => 'bar', 'raw' => true]);

        $this->assertEquals(true, $new['foo']['raw']);
    }

    /**
     *
     */
    function test_without()
    {
        $cookies = new HttpCookies(['foo' => ['foo', 'bar']]);

        $new = $cookies->without('foo');

        $this->assertEquals(['foo', 'bar'], $cookies['foo']);
        $this->assertNotEquals($cookies, $new);

        $cookie = ['name' => 'foo', 'value' => '', 'expires' => 946706400];

        $this->assertEquals($cookie, $new['foo']);
    }
}
