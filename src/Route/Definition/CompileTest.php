<?php
/**
 *
 */

namespace Mvc5\Test\Route\Definition;

use Mvc5\Route\Definition\Compiler;
use Mvc5\Route\Generator;
use Mvc5\Test\Test\TestCase;

class CompileTest
    extends TestCase
{
    /**
     *
     */
    function test_missing_required_parameter()
    {
        $compiler = new Compiler;

        $route = (new Generator)->__invoke([
            'path'      => '/{author}[/{category}][/{optional_missing_param}]',
            'defaults'   => [
                'category' => 'web'
            ]
        ]);

        $params = ['category' => 'bar'];

        $this->expectExceptionMessage('Missing parameter "author"');

        $compiler($route['tokens'], $params, $route['defaults']);
    }

    /**
     *
     */
    function test_optional_params_provided()
    {
        $compiler = new Compiler;

        $route = (new Generator)->__invoke([
            'path'      => '/[{author}[/{category}]]',
            'defaults'   => [
                'author'   => 'owner',
                'category' => 'web'
            ]
        ]);

        $params = ['author' => 'foo', 'category' => 'bar'];

        $this->assertEquals('/foo/bar', $compiler($route['tokens'], $params, $route['defaults']));
    }

    /**
     *
     */
    function test_param_with_no_name()
    {
        $compiler = new Compiler;

        $route = (new Generator)->__invoke(['path' => '/{$}']);

        $this->assertEquals('/', $compiler($route['tokens'], [], $route['defaults']));
    }

    /**
     *
     */
    function test_use_default_if_required_parameter()
    {
        $compiler = new Compiler;

        $route = (new Generator)->__invoke([
            'path'      => '/{author}[/{category}][/{optional_missing_param}]',
            'defaults'   => [
                'author'   => 'owner',
                'category' => 'web'
            ],
        ]);

        $params = ['category' => 'bar'];

        $this->assertEquals('/owner/bar', $compiler($route['tokens'], $params, $route['defaults']));
    }
}
