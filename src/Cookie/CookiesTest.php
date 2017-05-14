<?php
/**
 *
 */

namespace Mvc5\Test\Cookie;

use Mvc5\Cookie\PHPCookies;
use Mvc5\Test\Test\TestCase;

class CookiesTest
    extends TestCase
{
    /**
     * @return mixed
     */
    function cookies()
    {
        return new class() extends PHPCookies
        {
            /**
             * @var
             */
            public $cookie;

            /**
             * @param array $cookie
             * @return static
             */
            protected function setCookie(array $cookie)
            {
                $this->cookie = $cookie;
                return $this;
            }
        };
    }

    /**
     *
     */
    function test_remove()
    {
        $this->assertEquals(['foo', false, 946706400, '/', '', false, true], $this->cookies()->remove('foo')->cookie);
    }

    /**
     *
     */
    function test_set()
    {
        $this->assertEquals(['foo', 'bar', 0, '/', '', false, true], $this->cookies()->set('foo', 'bar')->cookie);
    }

    /**
     *
     */
    function test_with()
    {
        $this->assertEquals(['foo', 'bar', 0, '/', '', false, true], $this->cookies()->with('foo', 'bar')->cookie);
    }

    /**
     *
     */
    function test_without()
    {
        $this->assertEquals(['foo', false, 946706400, '/', '', false, true], $this->cookies()->withOut('foo')->cookie);
    }

    /**
     *
     */
    function test_value()
    {
        $cookies = new PHPCookies(['foo' => 'bar']);
        $this->assertEquals('bar', $cookies['foo']);
    }
}
