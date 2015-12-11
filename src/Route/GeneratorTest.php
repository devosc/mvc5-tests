<?php

namespace Mvc5\Test\Route;

use Mvc5\Arg;
use Mvc5\Route\Generator;
use Mvc5\Route\Definition;
use Mvc5\Test\Test\TestCase;

class GeneratorTest
    extends TestCase
{
    /**
     *
     */
    public function test_invoke()
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

        $this->assertInstanceOf(Definition::class, (new Generator)->__invoke($definition));
    }
}
