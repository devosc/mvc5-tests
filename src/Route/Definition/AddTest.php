<?php
/**
 *
 */

namespace Mvc5\Test\Route\Definition;

use Mvc5\Arg;
use Mvc5\Route\Definition\Add;
use Mvc5\Route\Definition\Config as Definition;
use Mvc5\Test\Test\TestCase;

class AddTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $add = new Add;

        $parent = new Definition;

        $definition = new Definition([
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::PARAM_MAP   => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => null,
            Arg::TOKENS      => null
        ]);

        $path = ['/'];

        $this->assertInstanceOf(Definition::class, $add($parent, $definition, $path));
    }

    /**
     *
     */
    function test_invoke_start()
    {
        $add = new Add;

        $parent = new Definition;

        $definition = new Definition([
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => 'foo',
            Arg::PARAM_MAP   => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => null,
            Arg::TOKENS      => null
        ]);

        $path = ['/'];

        $this->assertInstanceOf(Definition::class, $add($parent, $definition, $path, true));
    }

    /**
     *
     */
    function test_invoke_no_parent()
    {
        $add = new Add;

        $parent = new Definition;

        $definition = new Definition([
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::PARAM_MAP   => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => null,
            Arg::TOKENS      => null
        ]);

        $path = ['/', 'foo'];

        $this->setExpectedException('RuntimeException');

        $this->assertInstanceOf(Definition::class, $add($parent, $definition, $path));
    }

    /**
     *
     */
    function test_invoke_with_root()
    {
        $add = new Add;

        $parent = new Definition([
            Arg::CHILDREN    => [
                'bar' => new Definition
            ],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::PARAM_MAP   => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => null,
            Arg::TOKENS      => null
        ]);

        $definition = new Definition;

        $path = ['bar', 'baz'];

        $this->assertInstanceOf(Definition::class, $add($parent, $definition, $path));
    }
}
