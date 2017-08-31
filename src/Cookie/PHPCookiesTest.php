<?php
/**
 *
 */

namespace Mvc5\Test\Cookie;

use Mvc5\Config;
use Mvc5\Cookie\Config\PHPCookies;
use Mvc5\Cookie\Cookies;
use Mvc5\Test\Test\TestCase;

class PHPCookiesTest
    extends TestCase
{
    /**
     * @param array $cookies
     * @return mixed
     */
    protected function cookies(array $cookies = [])
    {
        return new class($cookies)
            extends Config
            implements Cookies
        {
            /**
             *
             */
            use PHPCookies;

            /**
             * @var array
             */
            public static $cookie;

            /**
             * @param array $cookie
             * @return mixed
             */
            static function send(array $cookie)
            {
                static::$cookie = static::params(...array_values($cookie));
            }
        };
    }

    /**
     *
     */
    function test_remove()
    {
        $cookies = $this->cookies();

        unset($cookies['foo']);

        $this->assertEquals(['foo', '', 946706400, '/', '', false, true], $cookies::$cookie);
    }

    /**
     *
     */
    function test_set()
    {
        $cookies = $this->cookies();

        $this->assertEquals('bar', $cookies['foo'] = 'bar');

        $this->assertEquals(['foo', 'bar', 0, '/', '', false, true], $cookies::$cookie);
    }

    /**
     *
     */
    function test_set_date_format()
    {
        $cookies = $this->cookies();

        $this->assertEquals('bar', $cookies->set('foo', 'bar', '+1 day'));

        $this->assertEquals(['foo', 'bar', strtotime('+1 day'), '/', '', false, true], $cookies::$cookie);
    }

    /**
     *
     */
    function test_set_date_format_invalid()
    {
        $cookies = $this->cookies();

        $this->assertEquals('bar', $cookies->set('foo', 'bar', 'foobar'));

        $this->assertEquals(['foo', 'bar', 0, '/', '', false, true], $cookies::$cookie);
    }

    /**
     *
     */
    function test_with()
    {
        $cookies = $this->cookies()->with('foo', 'bar');

        $this->assertEquals(['foo', 'bar', 0, '/', '', false, true], $cookies::$cookie);
    }

    /**
     *
     */
    function test_without()
    {
        $cookies = $this->cookies()->without('foo');

        $this->assertEquals(['foo', '', 946706400, '/', '', false, true], $cookies::$cookie);
    }

    /**
     *
     */
    function test_value()
    {
        $this->assertEquals('bar', $this->cookies(['foo' => 'bar'])['foo']);
    }
}
