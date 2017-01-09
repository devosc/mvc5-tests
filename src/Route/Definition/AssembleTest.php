<?php
/**
 *
 */

namespace Mvc5\Test\Route\Definition;

use Mvc5\Arg;
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
        $assemble = new Assemble;

        $options = $this->options([
            Arg::CANONICAL => true,
            Arg::HOST      => 'localhost',
            Arg::PORT      => '80',
            Arg::SCHEME    => 'http',
        ]);

        $this->assertEquals(
            'http://localhost/app', $assemble->assemble('http', 'localhost', '80', '/app', $options)
        );
    }

    /**
     *
     */
    function test_canonical_with_options_standard_http_no_scheme()
    {
        $assemble = new Assemble;

        $options = $this->options([
            Arg::CANONICAL  => true,
            Arg::HOST       => 'localhost',
            Arg::PORT       => '80',
            Arg::SCHEME     => null,
        ]);

        $this->assertEquals(
            '//localhost/app', $assemble->assemble(null, 'localhost', '80', '/app', $options)
        );
    }

    /**
     *
     */
    function test_canonical_with_options_not_standard_http()
    {
        $assemble = new Assemble;

        $options = $this->options([
            Arg::CANONICAL => true,
            Arg::HOST      => 'localhost',
            Arg::PORT      => '8080',
            Arg::SCHEME    => 'http',
        ]);

        $this->assertEquals(
            'http://localhost:8080/app', $assemble->assemble('http', 'localhost', '8080', '/app', $options)
        );
    }

    /**
     *
     */
    function test_different_domain_not_canonical_with_options_standard_http()
    {
        $assemble = new Assemble;

        $options = $this->options([
            Arg::HOST   => 'localhost',
            Arg::PORT   => '80',
            Arg::SCHEME => 'http',
        ]);

        $this->assertEquals(
            '//0.0.0.0/app', $assemble->assemble('http', '0.0.0.0', '80', '/app', $options)
        );
    }

    /**
     *
     */
    function test_different_domain_not_canonical_with_options_not_standard_http()
    {
        $assemble = new Assemble;

        $options = $this->options([
            Arg::HOST   => 'localhost',
            Arg::PORT   => '8080',
            Arg::SCHEME => 'http',
        ]);

        $this->assertEquals(
            'http://0.0.0.0:8080/app', $assemble->assemble('http', '0.0.0.0', '8080', '/app', $options)
        );
    }

    /**
     *
     */
    function test_different_domain_canonical_with_options_standard_http()
    {
        $assemble = new Assemble;

        $options = $this->options([
            Arg::CANONICAL => true,
            Arg::HOST      => 'localhost',
            Arg::PORT      => '80',
            Arg::SCHEME    => 'http',
        ]);

        $this->assertEquals(
            'http://0.0.0.0/app', $assemble->assemble('http', '0.0.0.0', '80', '/app', $options)
        );
    }

    /**
     *
     */
    function test_different_domain_canonical_with_options_not_standard_http()
    {
        $assemble = new Assemble;

        $options = $this->options([
            Arg::CANONICAL => true,
            Arg::HOST      => 'localhost',
            Arg::PORT      => '8080',
            Arg::SCHEME    => 'http',
        ]);

        $this->assertEquals(
            'http://0.0.0.0:8080/app', $assemble->assemble('http', '0.0.0.0', '8080', '/app', $options)
        );
    }

    /**
     *
     */
    function test_empty()
    {
        $assemble = new Assemble;

        $this->assertEmpty($assemble->assemble(null, null, null, null, $this->options()));
    }

    /**
     *
     */
    function test_not_canonical_no_options_standard_http()
    {
        $assemble = new Assemble;

        $this->assertEquals(
            'http://localhost/app', $assemble->assemble('http', 'localhost', '80', '/app', $this->options())
        );
    }

    /**
     *
     */
    function test_not_canonical_no_options_not_standard_http()
    {
        $assemble = new Assemble;

        $this->assertEquals(
            'http://localhost:8080/app', $assemble->assemble('http', 'localhost', '8080', '/app', $this->options())
        );
    }

    /**
     *
     */
    function test_not_canonical_with_options_standard_http()
    {
        $assemble = new Assemble;

        $options = $this->options([
            Arg::HOST   => 'localhost',
            Arg::PORT   => '80',
            Arg::SCHEME => 'http',
        ]);

        $this->assertEquals(
            '/app', $assemble->assemble('http', 'localhost', '80', '/app', $options)
        );
    }

    /**
     *
     */
    function test_options_only_not_canonical_standard_http()
    {
        $assemble = new Assemble;

        $options = $this->options([
            Arg::HOST   => 'localhost',
            Arg::PORT   => '80',
            Arg::SCHEME => 'http',
        ]);

        $this->assertEquals('/app', $assemble->assemble(null, null, null, '/app', $options));
    }

    /**
     *
     */
    function test_options_only_not_canonical_non_standard_http()
    {
        $assemble = new Assemble;

        $options = $this->options([
            Arg::HOST   => 'localhost',
            Arg::PORT   => '8080',
            Arg::SCHEME => 'http',
        ]);

        $this->assertEquals('http://localhost:8080/app', $assemble->assemble(null, null, null, '/app', $options));
    }

    /**
     *
     */
    function test_options_only_canonical_standard_http()
    {
        $assemble = new Assemble;

        $options = $this->options([
            Arg::CANONICAL => true,
            Arg::HOST      => 'localhost',
            Arg::PORT      => '80',
            Arg::SCHEME    => 'http',
        ]);

        $this->assertEquals('http://localhost/app', $assemble->assemble(null, null, null, '/app', $options));
    }

    /**
     *
     */
    function test_options_only_canonical_non_standard_http()
    {
        $assemble = new Assemble;

        $options = $this->options([
            Arg::CANONICAL => true,
            Arg::HOST      => 'localhost',
            Arg::PORT      => '8080',
            Arg::SCHEME    => 'http',
        ]);

        $this->assertEquals('http://localhost:8080/app', $assemble->assemble(null, null, null, '/app', $options));
    }

    /**
     *
     */
    function test_path_with_query_and_fragment()
    {
        $assemble = new Assemble;

        $options = $this->options([
            Arg::FRAGMENT => 'baz',
            Arg::QUERY    => ['foo' => 'bar'],
        ]);

        $this->assertEquals('/app?foo=bar#baz', $assemble->assemble(null, null, null, '/app', $options));
    }
}
