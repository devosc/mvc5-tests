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

use function Mvc5\Cookie\Config\cookie;
use function Mvc5\Cookie\Config\options;

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
            protected static $sent;

            /**
             * @param array $cookie
             * @param array $defaults
             * @return bool
             */
            static function send(array $cookie, array $defaults = [])
            {
                !is_string(key($cookie)) && $cookie = cookie(...$cookie);

                static::$sent = [
                    Arg::NAME => (string) $cookie[Arg::NAME],
                    Arg::VALUE => (string) $cookie[Arg::VALUE]
                ] + options($cookie, $defaults, PHPCookiesTest::php73());

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
     * @return bool
     */
    static function php73() : bool
    {
        return version_compare(\PHP_VERSION, '7.3', '>=');
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
    function test_defaults()
    {
        $cookies = $this->cookies(null, [
            Arg::EXPIRE    => 0,
            Arg::PATH      => '/foobar',
            Arg::DOMAIN    => 'foo.bar',
            Arg::SECURE    => false,
            Arg::HTTP_ONLY => true,
            Arg::SAMESITE  => '',
        ]);

        $this->assertEquals('bar', $cookies['foo'] = 'bar');

        $cookie = [
            'name' => 'foo',
            'value' => 'bar',
            'expire' => 0,
            'path' => '/foobar',
            'domain' => 'foo.bar',
            'secure' => false,
            'httponly' => true
        ] + ($this->php73() ? ['samesite' => ''] : []);

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
            'expire' => 0,
            'path' => '/foobar',
            'domain' => '',
            'secure' => false,
            'httponly' => false
        ] + ($this->php73() ? ['samesite' => ''] : []);

        $this->assertEquals($cookie, $cookies::sent());

        $cookies::send(['foo', 'bar', 0, '/foobar', '', true, false, 'Strict']);

        $cookie = [
            'name' => 'foo',
            'value' => 'bar',
            'expire' => 0,
            'path' => '/foobar',
            'domain' => '',
            'secure' => true,
            'httponly' => false
        ] + ($this->php73() ? ['samesite' => 'Strict'] : []);

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
            'expire' => 946706400,
            'path' => '/',
            'domain' => '',
            'secure' => false,
            'httponly' => true
        ] + ($this->php73() ? ['samesite' => ''] : []);

        $this->assertEquals($cookie, $cookies::sent());
    }

    /**
     *
     */
    function test_remove_array()
    {
        $cookies = $this->cookies();

        $cookies->remove(['foo', 'bar']);

        $this->assertEquals(946706400, $cookies::sent()['expire']);
    }

    /**
     *
     */
    function test_remove_assoc()
    {
        $cookies = $this->cookies();

        $cookies->remove(['name' => 'foo', 'value' => 'bar']);

        $this->assertEquals(946706400, $cookies::sent()['expire']);
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
            'expire' => 0,
            'path' => '/',
            'domain' => '',
            'secure' => false,
            'httponly' => true
        ] + ($this->php73() ? ['samesite' => ''] : []);

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
                'expire' => 0,
                'path' => '/',
                'domain' => '',
                'secure' => false,
                'httponly' => true
            ] + ($this->php73() ? ['samesite' => ''] : []);

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
                'expire' => 0,
                'path' => '/',
                'domain' => '',
                'secure' => false,
                'httponly' => true
            ] + ($this->php73() ? ['samesite' => ''] : []);

        $this->assertEquals($cookie, $cookies::sent());
    }

    /**
     *
     */
    function test_set_date_format()
    {
        $cookies = $this->cookies();

        $this->assertEquals('bar', $cookies->set('foo', 'bar', ['expire' => '+1 day']));

        $cookie = [
            'name' => 'foo',
            'value' => 'bar',
            'expire' => strtotime('+1 day'),
            'path' => '/',
            'domain' => '',
            'secure' => false,
            'httponly' => true
        ] + ($this->php73() ? ['samesite' => ''] : []);

        $this->assertEquals($cookie, $cookies::sent());
    }

    /**
     *
     */
    function test_set_date_format_invalid()
    {
        $cookies = $this->cookies();

        $this->assertEquals('bar', $cookies->set('foo', 'bar', ['expire' => 'foobar']));

        $cookie = [
            'name' => 'foo',
            'value' => 'bar',
            'expire' => 0,
            'path' => '/',
            'domain' => '',
            'secure' => false,
            'httponly' => true
        ] + ($this->php73() ? ['samesite' => ''] : []);

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
            'expire' => 0,
            'path' => '/',
            'domain' => '',
            'secure' => false,
            'httponly' => true
        ] + ($this->php73() ? ['samesite' => ''] : []);

        $this->assertEquals($cookie, $cookies::sent());
    }

    /**
     *
     */
    function test_with_options()
    {
        $cookies = $this->cookies()->with('foo', 'bar', ['expire' => '+1 day']);

        $cookie = [
            'name' => 'foo',
            'value' => 'bar',
            'expire' => strtotime('+1 day'),
            'path' => '/',
            'domain' => '',
            'secure' => false,
            'httponly' => true
        ] + ($this->php73() ? ['samesite' => ''] : []);

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
            'expire' => 946706400,
            'path' => '/',
            'domain' => '',
            'secure' => false,
            'httponly' => true
        ] + ($this->php73() ? ['samesite' => ''] : []);

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
            'expire' => 946706400,
            'path' => '/',
            'domain' => '',
            'secure' => true,
            'httponly' => false
        ] + ($this->php73() ? ['samesite' => 'Lax'] : []);

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
