<?php
/**
 *
 */

namespace Mvc5\Test\Cookie;

use Mvc5\ArrayObject;
use Mvc5\Cookie\Config\PHPCookies;
use Mvc5\Cookie\Cookies;
use Mvc5\Cookie\HttpCookies;
use Mvc5\Test\Test\TestCase;

use const Mvc5\Cookie\Config\EXPIRE_TIME;

use function Mvc5\Cookie\Config\cookie;
use function Mvc5\Cookie\Config\options;

class PHPCookiesTest
    extends TestCase
{
    /**
     * @param array $cookies
     * @param array $defaults
     * @return \Mvc5\Cookie\PHPCookies|mixed
     */
    protected function cookies(array $cookies = null, array $defaults = [])
    {
        return new class($cookies, $defaults)
            extends ArrayObject
            implements Cookies
        {
            /**
             *
             */
            use PHPCookies;

            /**
             * @var array
             */
            protected static $sent;

            /**
             * @param array $cookie
             * @param array $defaults
             * @return bool
             */
            static function send(array $cookie, array $defaults = [])
            {
                $cookie = cookie($cookie);

                static::$sent = ['name' => (string) $cookie['name'], 'value' => (string) $cookie['value']]
                    + options($cookie['options'] ?? $cookie, $defaults)
                    + (isset($cookie['raw']) ? ['raw' => $cookie['raw']] : []);

                return true;
            }

            /**
             * @return array
             */
            static function sent() : array
            {
                return static::$sent;
            }
        };
    }

    /**
     *
     */
    function test_super_global()
    {
        $_COOKIE = ['foo' => 'bar'];

        $cookies = $this->cookies();

        $this->assertEquals('bar', $cookies['foo']);
    }

    /**
     *
     */
    function test_static_defaults()
    {
        $cookies = $this->cookies();

        $cookies->send(['foo']);

        $cookie = [
                'name' => 'foo',
                'value' => '',
                'expires' => 0,
                'path' => '/',
                'domain' => '',
                'secure' => false,
                'httponly' => true,
                'samesite' => 'lax'
            ];

        $this->assertEquals($cookie, $cookies::sent());
    }

    /**
     *
     */
    function test_defaults()
    {
        $cookies = $this->cookies(null, [
            'expires'   => 0,
            'path'      => '/foobar',
            'domain'    => 'foo.bar',
            'secure'    => false,
            'httponly' => true,
            'samesite'  => '',
        ]);

        $this->assertEquals('bar', $cookies['foo'] = 'bar');

        $cookie = [
            'name' => 'foo',
            'value' => 'bar',
            'expires' => 0,
            'path' => '/foobar',
            'domain' => 'foo.bar',
            'secure' => false,
            'httponly' => true,
            'samesite' => ''
        ];

        $this->assertEquals($cookie, $cookies::sent());
    }

    /**
     *
     */
    function test_delete()
    {
        $cookies = $this->cookies();

        $cookies::delete('foo');

        $cookie = [
                'name' => 'foo',
                'value' => '',
                'expires' => EXPIRE_TIME,
                'path' => '/',
                'domain' => '',
                'secure' => false,
                'httponly' => true,
                'samesite' => 'lax'
            ];

        $this->assertEquals($cookie, $cookies::sent());
    }

    /**
     *
     */
    function test_send()
    {
        $cookies = $this->cookies();

        $cookies::send(['path' => '/foobar', 'name' => 'foo', 'value' => 'bar', 'httponly' => false]);

        $cookie = [
            'name' => 'foo',
            'value' => 'bar',
            'expires' => 0,
            'path' => '/foobar',
            'domain' => '',
            'secure' => false,
            'httponly' => false,
            'samesite' => 'lax'
        ];

        $this->assertEquals($cookie, $cookies::sent());

        $cookies::send(['foo', 'bar', 0, '/foobar', '', true, false, 'Strict']);

        $cookie = [
            'name' => 'foo',
            'value' => 'bar',
            'expires' => 0,
            'path' => '/foobar',
            'domain' => '',
            'secure' => true,
            'httponly' => false,
            'samesite' => 'Strict'
        ];

        $this->assertEquals($cookie, $cookies::sent());
    }

    /**
     *
     */
    function test_send_raw()
    {
        $cookies = $this->cookies();

        $cookie = ['path' => '/foobar', 'name' => 'foo', 'value' => 'bar', 'httponly' => false, 'raw' => true];

        $cookies::send((new HttpCookies(['foo' => $cookie]))['foo']);

        $cookie = [
                'name' => 'foo',
                'value' => 'bar',
                'expires' => 0,
                'path' => '/foobar',
                'domain' => '',
                'secure' => false,
                'httponly' => false,
                'raw' => true,
                'samesite' => 'lax'
            ];

        $this->assertEquals($cookie, $cookies::sent());
    }

    /**
     *
     */
    function test_remove()
    {
        $cookies = $this->cookies();

        unset($cookies['foo']);

        $cookie = [
            'name' => 'foo',
            'value' => '',
            'expires' => EXPIRE_TIME,
            'path' => '/',
            'domain' => '',
            'secure' => false,
            'httponly' => true,
            'samesite' => 'lax'
        ];

        $this->assertEquals($cookie, $cookies::sent());
    }

    /**
     *
     */
    function test_remove_array()
    {
        $cookies = $this->cookies();

        $cookies->remove(['foo', 'bar']);

        $this->assertEquals(EXPIRE_TIME, $cookies::sent()['expires']);
    }

    /**
     *
     */
    function test_remove_assoc()
    {
        $cookies = $this->cookies();

        $cookies->remove(['name' => 'foo', 'value' => 'bar']);

        $this->assertEquals(EXPIRE_TIME, $cookies::sent()['expires']);
    }

    /**
     *
     */
    function test_set()
    {
        $cookies = $this->cookies();

        $this->assertEquals('bar', $cookies['foo'] = 'bar');

        $cookie = [
            'name' => 'foo',
            'value' => 'bar',
            'expires' => 0,
            'path' => '/',
            'domain' => '',
            'secure' => false,
            'httponly' => true,
            'samesite' => 'lax'
        ];

        $this->assertEquals($cookie, $cookies::sent());
    }

    /**
     *
     */
    function test_set_array()
    {
        $cookies = $this->cookies();

        $this->assertEquals(['foo', 'bar'], $cookies->set(['foo', 'bar']));

        $cookie = [
                'name' => 'foo',
                'value' => 'bar',
                'expires' => 0,
                'path' => '/',
                'domain' => '',
                'secure' => false,
                'httponly' => true,
                'samesite' => 'lax'
            ];

        $this->assertEquals($cookie, $cookies::sent());
    }

    /**
     *
     */
    function test_set_associative_array()
    {
        $cookies = $this->cookies();

        $this->assertEquals(['name' => 'foo', 'value' => 'bar'], $cookies->set(['name' => 'foo', 'value' => 'bar']));

        $cookie = [
                'name' => 'foo',
                'value' => 'bar',
                'expires' => 0,
                'path' => '/',
                'domain' => '',
                'secure' => false,
                'httponly' => true,
                'samesite' => 'lax'
            ];

        $this->assertEquals($cookie, $cookies::sent());
    }

    /**
     *
     */
    function test_set_associative_array_with_options()
    {
        $cookies = $this->cookies();

        $this->assertEquals(
            ['name' => 'foo', 'value' => 'bar', 'options' => ['expires' => 100]],
            $cookies->set(['name' => 'foo', 'value' => 'bar', 'options' => ['expires' => 100]])
        );

        $cookie = [
                'name' => 'foo',
                'value' => 'bar',
                'expires' => 100,
                'path' => '/',
                'domain' => '',
                'secure' => false,
                'httponly' => true,
                'samesite' => 'lax'
            ];

        $this->assertEquals($cookie, $cookies::sent());
    }

    /**
     *
     */
    function test_set_date_format()
    {
        $cookies = $this->cookies();

        $this->assertEquals('bar', $cookies->set('foo', 'bar', ['expires' => '+1 day']));

        $cookie = [
            'name' => 'foo',
            'value' => 'bar',
            'expires' => strtotime('+1 day'),
            'path' => '/',
            'domain' => '',
            'secure' => false,
            'httponly' => true,
            'samesite' => 'lax'
        ];

        $this->assertEquals($cookie, $cookies::sent());
    }

    /**
     *
     */
    function test_set_date_format_invalid()
    {
        $cookies = $this->cookies();

        $this->assertEquals('bar', $cookies->set('foo', 'bar', ['expires' => 'foobar']));

        $cookie = [
            'name' => 'foo',
            'value' => 'bar',
            'expires' => 0,
            'path' => '/',
            'domain' => '',
            'secure' => false,
            'httponly' => true,
            'samesite' => 'lax'
        ];

        $this->assertEquals($cookie, $cookies::sent());
    }

    /**
     *
     */
    function test_with()
    {
        $cookies = $this->cookies()->with('foo', 'bar');

        $cookie = [
            'name' => 'foo',
            'value' => 'bar',
            'expires' => 0,
            'path' => '/',
            'domain' => '',
            'secure' => false,
            'httponly' => true,
            'samesite' => 'lax'
        ];

        $this->assertEquals($cookie, $cookies::sent());
    }

    /**
     *
     */
    function test_with_options()
    {
        $cookies = $this->cookies()->with('foo', 'bar', ['expires' => '+1 day']);

        $cookie = [
            'name' => 'foo',
            'value' => 'bar',
            'expires' => strtotime('+1 day'),
            'path' => '/',
            'domain' => '',
            'secure' => false,
            'httponly' => true,
            'samesite' => 'lax'
        ];

        $this->assertEquals($cookie, $cookies::sent());
    }

    /**
     *
     */
    function test_without()
    {
        $cookies = $this->cookies()->without('foo');

        $cookie = [
            'name' => 'foo',
            'value' => '',
            'expires' => EXPIRE_TIME,
            'path' => '/',
            'domain' => '',
            'secure' => false,
            'httponly' => true,
            'samesite' => 'lax'
        ];

        $this->assertEquals($cookie, $cookies::sent());
    }

    /**
     *
     */
    function test_without_options()
    {
        $cookies = $this->cookies()->without('foo', ['secure' => true, 'httponly' => false, 'samesite' => 'Lax']);

        $cookie = [
            'name' => 'foo',
            'value' => '',
            'expires' => EXPIRE_TIME,
            'path' => '/',
            'domain' => '',
            'secure' => true,
            'httponly' => false,
            'samesite' => 'Lax'
        ];

        $this->assertEquals($cookie, $cookies::sent());
    }

    /**
     *
     */
    function test_value()
    {
        $this->assertEquals('bar', $this->cookies(['foo' => 'bar'])['foo']);
    }
}
