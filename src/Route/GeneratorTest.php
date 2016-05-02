<?php
/**
 *
 */

namespace Mvc5\Test\Route;

use Mvc5\Arg;
use Mvc5\Route\Definition\Config as Definition;
use Mvc5\Route\Generator;
use Mvc5\Test\Test\TestCase;

class GeneratorTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $definition = [
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::PARAM_MAP   => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => '/',
            Arg::TOKENS      => null
        ];

        $generator = new Generator;

        $this->assertInstanceOf(Definition::class, $generator($definition));
    }
}
