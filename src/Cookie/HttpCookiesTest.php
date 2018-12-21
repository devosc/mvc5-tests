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
        $config = ['foo' => ['name' => 'bar', 'value' => '']];

        $cookies = (new HttpCookies($config))->all();

        $this->assertEquals($config, $cookies);
        $this->assertEquals(['name' => 'bar', 'value' => ''], $cookies['foo']);
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
    function test_without()
    {
        $cookies = new HttpCookies(['foo' => ['name' => 'bar', 'value' => '']]);

        $new = $cookies->without('foo');

        $this->assertNotEquals($cookies, $new);
        $this->assertEquals(['name' => 'bar', 'value' => ''], $cookies['foo']);

        $cookie = [
            'name' => 'foo',
            'value' => '',
            'expire' => 946706400
        ];

        $this->assertEquals($cookie, $new['foo']);
    }
}
