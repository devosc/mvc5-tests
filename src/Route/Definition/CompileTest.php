<?php
/**
 *
 */

namespace Mvc5\Test\Route\Definition;

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
        $compile = new Compile;

        $route = (new Generator)->__invoke([
            'route'      => '/{author}[/{category}][/{optional_missing_param}]',
            'defaults'   => [
                'category' => 'web'
            ]
        ]);

        $params = ['category' => 'bar'];

        $this->setExpectedException('InvalidArgumentException', 'Missing parameter "author"');

        $compile->compile($route['tokens'], $params, $route['defaults']);
    }

    /**
     *
     */
    function test_optional_params_provided()
    {
        $compile = new Compile;

        $route = (new Generator)->__invoke([
            'route'      => '/[{author}[/{category}]]',
            'defaults'   => [
                'author'   => 'owner',
                'category' => 'web'
            ]
        ]);

        $params = ['author' => 'foo', 'category' => 'bar'];

        $this->assertEquals('/foo/bar', $compile->compile($route['tokens'], $params, $route['defaults']));
    }

    /**
     *
     */
    function test_param_with_no_name()
    {
        $compile = new Compile;

        $route = (new Generator)->__invoke(['route' => '/{$}']);

        $this->assertEquals('/', $compile->compile($route['tokens'], [], $route['defaults']));
    }

    /**
     *
     */
    function test_use_default_if_required_parameter()
    {
        $compile = new Compile;

        $route = (new Generator)->__invoke([
            'route'      => '/{author}[/{category}][/{optional_missing_param}]',
            'defaults'   => [
                'author'   => 'owner',
                'category' => 'web'
            ],
        ]);

        $params = ['category' => 'bar'];

        $this->assertEquals('/owner/bar', $compile->compile($route['tokens'], $params, $route['defaults']));
    }
}
