<?php
/**
 *
 */

namespace Mvc5\Test\Cookie;

use Mvc5\Cookie\Config as Cookies;
use Mvc5\Test\Test\TestCase;

class CookiesTest
    extends TestCase
{
    /**
     * @return mixed
     */
    function cookies()
    {
        return new class() extends Cookies
        {
            /**
             * @param array $cookie
             * @return array
             */
            protected function setCookie(array $cookie)
            {
                return $cookie;
            }
        };
    }

    /**
     *
     */
    function test_remove()
    {
        $this->assertEquals(['foo', false, 946706400, '/', '', false, true], $this->cookies()->remove('foo'));
    }

    /**
     *
     */
    function test_set()
    {
        $this->assertEquals(['foo', 'bar', 0, '/', '', false, true], $this->cookies()->set('foo', 'bar'));
    }

    /**
     *
     */
    function test_value()
    {
        $cookies = new Cookies(['foo' => 'bar']);
        $this->assertEquals('bar', $cookies['foo']);
    }
}
