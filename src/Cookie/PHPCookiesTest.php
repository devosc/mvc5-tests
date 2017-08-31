<?php
/**
 *
 */

namespace Mvc5\Test\Cookie;

use Mvc5\Arg;
use Mvc5\Config;
use Mvc5\Cookie\Config\PHPCookies;
use Mvc5\Cookie\Cookies;
use Mvc5\Test\Test\TestCase;

class PHPCookiesTest
    extends TestCase
{
    /**
     * @param array $cookies
     * @param array $defaults
     * @return mixed
     */
    protected function cookies(array $cookies = null, array $defaults = [])
    {
        return new class($cookies, $defaults)
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
            static $cookie;

            /**
             * @param array $cookie
             * @return bool
             */
            static function send(array $cookie)
            {
                static::$cookie = static::params(...array_values($cookie));
                return true;
            }
        };
    }

    /**
     *
     */
    function test_super_global()
    {
        $_COOKIE = [
            'foo' => 'bar'
        ];

        $cookies = $this->cookies();

        $this->assertEquals('bar', $cookies['foo']);
    }

    /**
     *
     */
    function test_defaults()
    {
        $cookies = $this->cookies(null, [
            Arg::EXPIRE    => 0,
            Arg::PATH      => '/foobar',
            Arg::DOMAIN    => 'foo.bar',
            Arg::SECURE    => false,
            Arg::HTTP_ONLY => true
        ]);

        $this->assertEquals('bar', $cookies['foo'] = 'bar');

        $this->assertEquals(['foo', 'bar', 0, '/foobar', 'foo.bar', false, true], $cookies::$cookie);
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
