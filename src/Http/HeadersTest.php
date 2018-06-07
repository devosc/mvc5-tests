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
        $config = ['bar' => 'baz', 'foobar' => ['foo', 'bar']];

        $headers = new HttpHeaders($config);

        $this->assertEquals($config, $headers->all());
        $this->assertEquals('baz', $headers->current());
        $this->assertTrue(isset($headers['bar']));
        $this->assertEquals('baz', $headers['bar']);

        $with = $headers->with(['Host' => 'foo']);

        $this->assertFalse(isset($headers['Host']));
        $this->assertEquals('foo', $with->current());
        $this->assertTrue(isset($with['bar']));
        $this->assertEquals('baz', $with['bar']);
        $this->assertTrue(isset($with['Host']));
        $this->assertEquals('foo', $with['host']);
        $this->assertEquals(['foo', 'bar'], $with['foobar']);

        $without = $headers->without('Host');

        $this->assertFalse(isset($without['Host']));

        $with = $headers->with('Host', 'foo');
        $this->assertTrue(isset($with['Host']));
        $this->assertEquals('foo', $with['host']);

        $with = $headers->with(['baz' => 'bat']);
        $this->assertTrue($with->has('baz'));
        $this->assertEquals('bat', $with->get('baz'));
        $this->assertFalse($with->has(['Host', 'baz']));
        $this->assertTrue($with->has(['baz', 'foobar']));
        $this->assertEquals(
            ['Host' => null, 'baz' => 'bat', 'foobar' => ['foo', 'bar']], $with->get(['Host', 'baz', 'foobar'])
        );
    }
}
