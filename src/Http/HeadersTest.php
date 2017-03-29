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
        $headers = new Headers(['bar' => 'baz', 'Host' => 'foo']);

        $this->assertEquals('foo', $headers->current());
        $this->assertTrue(isset($headers['bar']));
        $this->assertEquals('baz', $headers['bar']);
        $this->assertTrue(isset($headers['Host']));
        $this->assertEquals('foo', $headers['host']);

        unset($headers['host']);

        $this->assertFalse(isset($headers['Host']));

        $with = $headers->with(['bar' => 'baz', 'Host' => 'foo']);

        $this->assertFalse(isset($headers['Host']));
        $this->assertEquals('foo', $with->current());
        $this->assertTrue(isset($with['bar']));
        $this->assertEquals('baz', $with['bar']);
        $this->assertTrue(isset($with['Host']));
        $this->assertEquals('foo', $with['host']);

        $without = $headers->without('Host');

        $this->assertFalse(isset($without['Host']));
    }
}
