<?php
/**
 *
 */

namespace Mvc5\Test\Http;

use Mvc5\Http\HttpHeaders;
use Mvc5\Test\Test\TestCase;

class HeadersTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $headers = new HttpHeaders(['bar' => 'baz']);

        $this->assertEquals('baz', $headers->current());
        $this->assertTrue(isset($headers['bar']));
        $this->assertEquals('baz', $headers['bar']);

        $with = $headers->with(['Host' => 'foo', 'foobar' => ['foo' => 'bar']]);

        $this->assertFalse(isset($headers['Host']));
        $this->assertEquals('foo', $with->current());
        $this->assertTrue(isset($with['bar']));
        $this->assertEquals('baz', $with['bar']);
        $this->assertTrue(isset($with['Host']));
        $this->assertEquals('foo', $with['host']);
        $this->assertEquals(['foo' => 'bar'], $with['foobar']);

        $without = $headers->without('Host');

        $this->assertFalse(isset($without['Host']));

        $with = $headers->with('Host', 'foo');
        $this->assertTrue(isset($with['Host']));
        $this->assertEquals('foo', $with['host']);

        $with = $headers->with(['baz' => 'bat']);
        $this->assertTrue(isset($with['baz']));
        $this->assertEquals('bat', $with['baz']);
    }
}
