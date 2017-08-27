<?php
/**
 *
 */

namespace Mvc5\Test\Cookie;

use Mvc5\Cookie\PHPCookies;
use Mvc5\Test\Test\TestCase;

/**
 * @runTestsInSeparateProcesses
 */
class PHPCookiesTest
    extends TestCase
{
    /**
     * @param array $cookies
     * @return mixed
     */
    protected function cookies(array $cookies = [])
    {
        return new class($cookies) extends PHPCookies
        {
            /**
             * @var array
             */
            public $cookie;

            /**
             * @param string $name
             * @param string $value
             * @param int|null|string $expire
             * @param string|null $path
             * @param string|null $domain
             * @param bool|null $secure
             * @param bool|null $httponly
             * @return mixed
             */
            function set($name, $value = '', $expire = null,
                         string $path = null, string $domain = null, bool $secure = null, bool $httponly = null)
            {
                $this->cookie = $this->cookie($name, $value, $expire, $path, $domain, $secure, $httponly);
                return parent::set($name, $value);
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

        $cookie = [
            'name' => 'foo', 'value' => '', 'expire' => 946706400,
            'path' => '/', 'domain' => '', 'secure' => false, 'httponly' => true
        ];

        $this->assertEquals($cookie, $cookies->cookie);
    }

    /**
     *
     */
    function test_set()
    {
        $cookies = $this->cookies();

        $this->assertEquals('bar', $cookies['foo'] = 'bar');

        $cookie = [
            'name' => 'foo', 'value' => 'bar', 'expire' => 0,
            'path' => '/', 'domain' => '', 'secure' => false, 'httponly' => true
        ];

        $this->assertEquals($cookie, $cookies->cookie);
    }

    /**
     *
     */
    function test_set_date_format()
    {
        $cookies = $this->cookies();

        $this->assertEquals('bar', $cookies->set('foo', 'bar', '+1 day'));

        $cookie = [
            'name' => 'foo', 'value' => 'bar', 'expire' => strtotime('+1 day'),
            'path' => '/', 'domain' => '', 'secure' => false, 'httponly' => true
        ];

        $this->assertEquals($cookie, $cookies->cookie);
    }

    /**
     *
     */
    function test_set_date_format_invalid()
    {
        $cookies = $this->cookies();

        $this->assertEquals('bar', $cookies->set('foo', 'bar', 'foobar'));

        $cookie = [
            'name' => 'foo', 'value' => 'bar', 'expire' => 0,
            'path' => '/', 'domain' => '', 'secure' => false, 'httponly' => true
        ];

        $this->assertEquals($cookie, $cookies->cookie);
    }

    /**
     *
     */
    function test_with()
    {
        $cookie = [
            'name' => 'foo', 'value' => 'bar', 'expire' => 0,
            'path' => '/', 'domain' => '', 'secure' => false, 'httponly' => true
        ];

        $this->assertEquals($cookie, $this->cookies()->with('foo', 'bar')->cookie);
    }

    /**
     *
     */
    function test_without()
    {
        $cookie = [
            'name' => 'foo', 'value' => '', 'expire' => 946706400,
            'path' => '/', 'domain' => '', 'secure' => false, 'httponly' => true
        ];

        $this->assertEquals($cookie, $this->cookies()->without('foo')->cookie);
    }

    /**
     *
     */
    function test_value()
    {
        $this->assertEquals('bar', $this->cookies(['foo' => 'bar'])['foo']);
    }
}
