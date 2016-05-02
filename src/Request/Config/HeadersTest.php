<?php
/**
 *
 */

namespace Mvc5\Test\Request\Config;

use Mvc5\Request\Headers\Config as Headers;
use Mvc5\Test\Test\TestCase;

class HeadersTest
    extends TestCase
{
    /**
     *
     */
    function test_constructor()
    {
        $this->assertInstanceOf(Headers::class, new Headers);
    }

    /**
     *
     */
    function test_set()
    {
        $headers = new Headers;

        $this->assertEquals('bar', $headers->set('foo', 'bar'));
    }
}
