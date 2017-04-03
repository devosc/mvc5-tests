<?php
/**
 *
 */

namespace Mvc5\Test\Url;

use Mvc5\Arg;
use Mvc5\Url\Assemble;
use Mvc5\Test\Test\TestCase;

class AssembleTest
    extends TestCase
{
    /**
     * Options represent the current route and are used to determine how much of the full non-canonical url to build.
     *
     * @param array $options
     * @return array
     */
    protected function options(array $options = [])
    {
        return $options + [Arg::SCHEME => null, Arg::HOST => null, Arg::PORT => null, Arg::QUERY => []];
    }

    /**
     *
     */
    function test_canonical_with_options_standard_http()
    {
        $options = $this->options([
            Arg::CANONICAL => true,
            Arg::HOST      => 'localhost',
            Arg::PORT      => '80',
            Arg::SCHEME    => 'http',
        ]);

        $this->assertEquals(
            'http://localhost/app', (new Assemble)('http', 'localhost', '80', '/app', $options)
        );
    }

    /**
     *
     */
    function test_canonical_with_options_standard_http_no_scheme()
    {
        $options = $this->options([
            Arg::CANONICAL  => true,
            Arg::HOST       => 'localhost',
            Arg::PORT       => '80',
            Arg::SCHEME     => null,
        ]);

        $this->assertEquals(
            '//localhost/app', (new Assemble)(null, 'localhost', '80', '/app', $options)
        );
    }

    /**
     *
     */
    function test_canonical_with_options_not_standard_http()
    {
        $options = $this->options([
            Arg::CANONICAL => true,
            Arg::HOST      => 'localhost',
            Arg::PORT      => '8080',
            Arg::SCHEME    => 'http',
        ]);

        $this->assertEquals(
            'http://localhost:8080/app', (new Assemble)('http', 'localhost', '8080', '/app', $options)
        );
    }

    /**
     *
     */
    function test_different_domain_not_canonical_with_options_standard_http()
    {
        $options = $this->options([
            Arg::HOST   => 'localhost',
            Arg::PORT   => '80',
            Arg::SCHEME => 'http',
        ]);

        $this->assertEquals(
            '//0.0.0.0/app', (new Assemble)('http', '0.0.0.0', '80', '/app', $options)
        );
    }

    /**
     *
     */
    function test_different_domain_not_canonical_with_options_not_standard_http()
    {
        $options = $this->options([
            Arg::HOST   => 'localhost',
            Arg::PORT   => '8080',
            Arg::SCHEME => 'http',
        ]);

        $this->assertEquals(
            'http://0.0.0.0:8080/app', (new Assemble)('http', '0.0.0.0', '8080', '/app', $options)
        );
    }

    /**
     *
     */
    function test_different_domain_canonical_with_options_standard_http()
    {
        $options = $this->options([
            Arg::CANONICAL => true,
            Arg::HOST      => 'localhost',
            Arg::PORT      => '80',
            Arg::SCHEME    => 'http',
        ]);

        $this->assertEquals(
            'http://0.0.0.0/app', (new Assemble)('http', '0.0.0.0', '80', '/app', $options)
        );
    }

    /**
     *
     */
    function test_different_domain_canonical_with_options_not_standard_http()
    {
        $options = $this->options([
            Arg::CANONICAL => true,
            Arg::HOST      => 'localhost',
            Arg::PORT      => '8080',
            Arg::SCHEME    => 'http',
        ]);

        $this->assertEquals(
            'http://0.0.0.0:8080/app', (new Assemble)('http', '0.0.0.0', '8080', '/app', $options)
        );
    }

    /**
     *
     */
    function test_empty()
    {
        $this->assertEmpty((new Assemble)(null, null, null, null, $this->options()));
    }

    /**
     *
     */
    function test_not_canonical_no_options_standard_http()
    {
        $this->assertEquals(
            'http://localhost/app', (new Assemble)('http', 'localhost', '80', '/app', $this->options())
        );
    }

    /**
     *
     */
    function test_not_canonical_no_options_not_standard_http()
    {
        $this->assertEquals(
            'http://localhost:8080/app', (new Assemble)('http', 'localhost', '8080', '/app', $this->options())
        );
    }

    /**
     *
     */
    function test_not_canonical_with_options_standard_http()
    {
        $options = $this->options([
            Arg::HOST   => 'localhost',
            Arg::PORT   => '80',
            Arg::SCHEME => 'http',
        ]);

        $this->assertEquals('/app', (new Assemble)('http', 'localhost', '80', '/app', $options));
    }

    /**
     *
     */
    function test_options_only_not_canonical_standard_http()
    {
        $options = $this->options([
            Arg::HOST   => 'localhost',
            Arg::PORT   => '80',
            Arg::SCHEME => 'http',
        ]);

        $this->assertEquals('/app', (new Assemble)(null, null, null, '/app', $options));
    }

    /**
     *
     */
    function test_options_only_not_canonical_non_standard_http()
    {
        $options = $this->options([
            Arg::HOST   => 'localhost',
            Arg::PORT   => '8080',
            Arg::SCHEME => 'http',
        ]);

        $this->assertEquals('http://localhost:8080/app', (new Assemble)(null, null, null, '/app', $options));
    }

    /**
     *
     */
    function test_options_only_canonical_standard_http()
    {
        $options = $this->options([
            Arg::CANONICAL => true,
            Arg::HOST      => 'localhost',
            Arg::PORT      => '80',
            Arg::SCHEME    => 'http',
        ]);

        $this->assertEquals('http://localhost/app', (new Assemble)(null, null, null, '/app', $options));
    }

    /**
     *
     */
    function test_options_only_canonical_non_standard_http()
    {
        $options = $this->options([
            Arg::CANONICAL => true,
            Arg::HOST      => 'localhost',
            Arg::PORT      => '8080',
            Arg::SCHEME    => 'http',
        ]);

        $this->assertEquals('http://localhost:8080/app', (new Assemble)(null, null, null, '/app', $options));
    }

    /**
     *
     */
    function test_path_with_query_and_fragment()
    {
        $options = $this->options([
            Arg::FRAGMENT => 'baz',
            Arg::QUERY    => ['foo' => 'bar'],
        ]);

        $this->assertEquals('/app?foo=bar#baz', (new Assemble)(null, null, null, '/app', $options));
    }
}
