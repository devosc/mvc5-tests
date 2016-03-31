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
    public function test_compile()
    {
        $compile = new Compile;

        $definition = (new Generator)->__invoke([
            'route'      => '[:no_constraint]/:author[/:category]',
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

        $args = ['category' => 'bar'];

        $tokens = $definition['tokens'];

        $defaults = $definition['defaults'];

        $this->setExpectedException('InvalidArgumentException', 'Missing parameter "author"');

        $compile->compile($tokens, $args, $defaults);
    }

    /**
     *
     */
    public function test_compile_no_default_param()
    {
        $compile = new Compile;

        $definition = (new Generator)->__invoke([
            'route'      => '[:no_constraint]/:author[/:category]',
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

        $args = ['category' => 'bar'];

        $tokens = $definition['tokens'];

        $defaults = $definition['defaults'];

        $this->setExpectedException('InvalidArgumentException', 'Missing parameter "author"');

        $compile->compile($tokens, $args, $defaults);
    }

    /**
     *
     */
    public function test_compile_param_path()
    {
        $compile = new Compile;

        $definition = (new Generator)->__invoke([
            'route'      => '/[:author[/:category]]',
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

        $args = ['author' => 'foo', 'category' => 'bar'];

        $tokens = $definition['tokens'];
        //$tokens = array_merge($definition['tokens'], [['foo', 'bar']]);

        $defaults = $definition['defaults'];

        $this->assertEquals('/foo/bar', $compile->compile($tokens, $args, $defaults));
    }
}
