<?php

namespace Mvc5\Test\Route\Definition\Build;

use Mvc5\Route\Definition\Route\Route;
use Mvc5\Test\Test\TestCase;

class CompileTest
    extends TestCase
{
    /**
     *
     */
    public function test_compile()
    {
        $mock = $this->getCleanMock(Compile::class, ['compile', 'testCompile']);

        $definition = (new Route)->__invoke([
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

        $mock->testCompile($tokens, $args, $defaults);
    }

    /**
     *
     */
    public function test_compile_no_default_param()
    {
        $mock = $this->getCleanMock(Compile::class, ['compile', 'testCompile']);

        $definition = (new Route)->__invoke([
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

        $mock->testCompile($tokens, $args, $defaults);
    }

    /**
     *
     */
    public function test_compile_param_path()
    {
        $mock = $this->getCleanMock(Compile::class, ['compile', 'testCompile']);

        $definition = (new Route)->__invoke([
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

        $defaults = $definition['defaults'];

        $this->assertEquals('/foo/bar', $mock->testCompile($tokens, $args, $defaults));
    }
}
