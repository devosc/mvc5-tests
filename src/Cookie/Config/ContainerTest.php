<?php
/**
 *
 */

namespace Mvc5\Test\Cookie\Config;

use Mvc5\Cookie\Container;
use Mvc5\Test\Test\TestCase;

class ContainerTest
    extends TestCase
{
    /**
     *
     */
    function test_remove_cookie()
    {
        $container = new Container;

        $container->remove('foo');

        $cookie =  [
            'name'     => 'foo',
            'value'    => false,
            'expire'   => 946706400,
            'path'     => '/',
            'domain'   => '',
            'secure'   => false,
            'httponly' => true
        ];

        $this->assertEquals($cookie, $container['foo']);
    }

    /**
     *
     */
    function test_set_cookie()
    {
        $container = new Container;

        $this->assertEquals('bar', $container->set('foo', 'bar', null, null, null, null, null));
    }
}
