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
    function test_compile()
    {
        $compile = new Compile;

        $route = (new Generator)->__invoke([
            'route'      => '[{no_constraint}]/{author}[/{category}]',
            'defaults'   => [
                'author'   => 'owner',
                'category' => 'web'
            ],
            'wildcard'   => false,
            'controller' => '@blog:create',
            'constraints' => [
                'author'   => '[a-zA-Z0-9_-]*',
                'category' => '[a-zA-Z0-9_-]*'
            ]
        ]);

        $params = ['category' => 'bar'];

        $tokens = $route['tokens'];

        $defaults = $route['defaults'];

        $this->setExpectedException('InvalidArgumentException', 'Missing parameter "author"');

        $compile->compile($tokens, $params, $defaults);
    }

    /**
     *
     */
    function test_compile_not_named()
    {
        $compile = new Compile;

        $route = (new Generator)->__invoke(['route' => '/{:$}']);

        $params = ['category' => 'bar'];

        $tokens = $route['tokens'];

        $defaults = $route['defaults'];

        $this->assertEquals('/', $compile->compile($tokens, $params, $defaults));
    }

    /**
     *
     */
    function test_compile_no_default_arg()
    {
        $compile = new Compile;

        $route = (new Generator)->__invoke([
            'route'      => '[{no_constraint}]/{author}[/{category}]',
            'defaults'   => [
                //'author'   => 'owner',
                'category' => 'web'
            ],
            'wildcard'   => false,
            'controller' => '@blog:create',
            'constraints' => [
                'author'   => '[a-zA-Z0-9_-]*',
                'category' => '[a-zA-Z0-9_-]*'
            ]
        ]);

        $params = ['category' => 'bar'];

        $tokens = $route['tokens'];

        $defaults = $route['defaults'];

        $this->setExpectedException('InvalidArgumentException', 'Missing parameter "author"');

        $compile->compile($tokens, $params, $defaults);
    }

    /**
     *
     */
    function test_compile_arg_path()
    {
        $compile = new Compile;

        $route = (new Generator)->__invoke([
            'route'      => '/[{author}[/{category}]]',
            'defaults'   => [
                'author'   => 'owner',
                'category' => 'web'
            ],
            'wildcard'   => false,
            'controller' => '@blog:create',
            'constraints' => [
                'author'   => '[a-zA-Z0-9_-]*',
                'category' => '[a-zA-Z0-9_-]*'
            ]
        ]);

        $params = ['author' => 'foo', 'category' => 'bar'];

        $tokens = $route['tokens'];

        $defaults = $route['defaults'];

        $this->assertEquals('/foo/bar', $compile->compile($tokens, $params, $defaults));
    }
}
