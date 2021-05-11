<?php
/**
 *
 */

namespace Mvc5\Test\Cookie;

use Mvc5\Cookie\HttpCookies;
use Mvc5\Test\Test\TestCase;
use PHPUnit\Framework\Exception;

use const Mvc5\COOKIE_EXPIRE_TIME;

final class HttpCookiesTest
    extends TestCase
{
    /**
     *
     */
    function test_all()
    {
        $bat = ['baz', 'bat'];
        $baz = ['name' => 'foo', 'value' => 'foobar', 'options' => ['expire' => 0]];
        $foo = ['name' => 'foo', 'value' => 'foobar'];
        $config = ['bat' => $bat, 'baz' => $baz, 'foo' => $foo];

        $cookies = (new HttpCookies($config))->all();
        $this->assertEquals($config, $cookies);
        $this->assertEquals($bat, $cookies['bat']);
        $this->assertEquals($baz, $cookies['baz']);
        $this->assertEquals($foo, $cookies['foo']);
    }

    /**
     *
     */
    function test_with()
    {
        $cookies = new HttpCookies;

        $new = $cookies->with('foo', 'bar', ['expire' => 0]);

        $this->assertNotSame($cookies, $new);

        $cookie = ['name' => 'foo', 'value' => 'bar', 'expire' => 0];

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

        $cookie = ['name' => 'foo', 'value' => 'bar'];

        $new = $cookies->with($cookie);

        $this->assertNotSame($cookies, $new);
        $this->assertEquals($cookie, $new['foo']);
    }

    /**
     *
     */
    function test_with_associative_array_with_options()
    {
        $cookies = new HttpCookies;

        $cookie = ['name' => 'foo', 'value' => 'bar', 'options' => ['expire' => 0]];

        $new = $cookies->with($cookie);

        $this->assertNotSame($cookies, $new);
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
        $cookie = ['name' => 'foo', 'value' => 'bar'];
        $expired = ['name' => 'foo', 'value' => '', 'expires' => COOKIE_EXPIRE_TIME];

        $cookies = new HttpCookies(['foo' => $cookie]);

        $new = $cookies->without('foo');

        $this->assertEquals($cookie, $cookies['foo']);
        $this->assertNotEquals($cookies, $new);
        $this->assertEquals($expired, $new['foo']);
    }

    /**
     *
     */
    function test_without_array()
    {
        $cookie = ['name' => 'foo', 'value' => 'bar'];

        $expired = ['name' => 'foo', 'value' => '', 'expires' => COOKIE_EXPIRE_TIME,
            'path' => null, 'domain' => null, 'secure' => null, 'httponly' => null, 'samesite' => null];

        $cookies = new HttpCookies(['foo' => $cookie]);

        $new = $cookies->without(['foo']);

        $this->assertEquals($cookie, $cookies['foo']);
        $this->assertNotEquals($cookies, $new);
        $this->assertEquals($expired, $new['foo']);
    }

    /**
     *
     */
    function test_without_associative_array()
    {
        $cookie = ['name' => 'foo', 'value' => 'bar'];
        $expired = ['name' => 'foo', 'value' => '', 'expires' => COOKIE_EXPIRE_TIME];

        $cookies = new HttpCookies(['foo' => $cookie]);

        $new = $cookies->without(['name' => 'foo']);

        $this->assertEquals($cookie, $cookies['foo']);
        $this->assertNotEquals($cookies, $new);
        $this->assertEquals($expired, $new['foo']);
    }

    /**
     *
     */
    function test_without_associative_array_with_options()
    {
        $cookie = ['name' => 'foo', 'value' => 'bar', 'options' => ['path' => '/']];
        $expired = ['name' => 'foo', 'value' => '', 'options' => ['path' => '/', 'expires' => COOKIE_EXPIRE_TIME]];

        $cookies = new HttpCookies(['foo' => $cookie]);

        $new = $cookies->without($cookie);

        $this->assertEquals($cookie, $cookies['foo']);
        $this->assertNotEquals($cookies, $new);
        $this->assertEquals($expired, $new['foo']);
    }

    /**
     *
     */
    function test_invalid_name()
    {
        $cookies = new HttpCookies;

        try {

            $cookies->without([]);

        } catch(Exception $e) {

            $this->assertEquals('Undefined array key 0', $e->getMessage());

        }
    }

    /**
     *
     */
    function test_invalid_associative_name()
    {
        $cookies = new HttpCookies;

        try {

            $cookies->without(['value' => '']);

        } catch(Exception $e) {

            $this->assertEquals('Undefined array key "name"', $e->getMessage());

        }
    }
}
