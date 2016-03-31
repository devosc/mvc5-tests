<?php
/**
 *
 */

namespace Mvc5\Test\Route\Definition;

use Mvc5\Arg;
use Mvc5\Route\Definition;
use Mvc5\Route\Definition\Config;
use Mvc5\Test\Test\TestCase;

class BuildTest
    extends TestCase
{
    /**
     *
     */
    public function test_definition()
    {
        $build = new Build;

        $definition = [
            Arg::CHILDREN    => ['foo' => [Arg::ROUTE => 'foo']],
            Arg::CONSTRAINTS => null,
            Arg::NAME        => null,
            Arg::PARAM_MAP   => null,
            Arg::REGEX       => null,
            Arg::ROUTE       => '/',
            Arg::TOKENS      => null
        ];

        $this->assertInternalType('array', $build->definition($definition, true, true));
    }

    /**
     *
     */
    public function test_definition_no_route_exception()
    {
        $build = new Build;

        $this->setExpectedException('RuntimeException');

        $build->definition([]);
    }

    /**
     *
     */
    public function test_children()
    {
        $build = new Build;

        $definitions = [
            [
                Arg::CHILDREN    => [],
                Arg::CONSTRAINTS => [],
                Arg::NAME        => null,
                Arg::PARAM_MAP   => [],
                Arg::REGEX       => null,
                Arg::ROUTE       => '/',
                Arg::TOKENS      => null
            ]
        ];

        $this->assertInternalType('array', $build->children($definitions));
    }

    /**
     *
     */
    public function test_create_route_definition()
    {
        $build = new Build;

        $definition = new Config([
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::PARAM_MAP   => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => '/',
            Arg::TOKENS      => null
        ]);

        $this->assertInstanceOf(Config::class, $build->create($definition));
    }

    /**
     *
     */
    public function test_create_with_class_name()
    {
        $build = new Build;

        $definition = [
            Arg::CHILDREN    => [],
            Arg::CLASS_NAME  => Config::class,
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::PARAM_MAP   => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => '/',
            Arg::TOKENS      => null
        ];

        $this->assertInstanceOf(Config::class, $build->create($definition));
    }

    /**
     *
     */
    public function test_create()
    {
        $build = new Build;

        $definition = [
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::PARAM_MAP   => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => '/',
            Arg::TOKENS      => null
        ];

        $this->assertInstanceOf(Config::class, $build->create($definition));
    }

    /**
     *
     */
    public function test_create_default()
    {
        $build = new Build;

        $definition = [
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::PARAM_MAP   => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => '/',
            Arg::TOKENS      => null
        ];

        $this->assertInstanceOf(Config::class, $build->createDefault($definition));
    }

    /**
     *
     */
    public function test_build()
    {
        $build = new Build;

        $definition = [
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::PARAM_MAP   => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => '/',
            Arg::TOKENS      => null
        ];

        $this->assertInstanceOf(Definition::class, $build->build($definition));
    }
}
