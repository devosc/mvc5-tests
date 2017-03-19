<?php
/**
 *
 */

namespace Mvc5\Test\Http;

use Mvc5\Http\Headers\Config as Headers;
use Mvc5\Test\Test\TestCase;

class HeadersTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $headers = new Headers(['Host' => 'foo']);

        $this->assertTrue(isset($headers['Host']));
        $this->assertEquals('foo', $headers['host']);

        unset($headers['host']);

        $this->assertFalse(isset($headers['Host']));

        $with = $headers->with('Host', 'foo');

        $this->assertFalse(isset($headers['Host']));
        $this->assertTrue(isset($with['Host']));
        $this->assertEquals('foo', $with['host']);

        $without = $headers->without('Host');

        $this->assertFalse(isset($without['Host']));
    }
}
