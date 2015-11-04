<?php

namespace Mvc5\Test\Route\Definition\Build;

use Mvc5\Route\Definition\Definition;
use Mvc5\Route\Definition\Route\Route;
use Mvc5\Test\Test\TestCase;

class RouteTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        $definition = [
            Definition::CHILDREN    => [],
            Definition::CONSTRAINTS => [],
            Definition::NAME        => null,
            Definition::PARAM_MAP   => [],
            Definition::REGEX       => null,
            Definition::ROUTE       => '/',
            Definition::TOKENS      => null
        ];

        $this->assertInstanceOf(Definition::class, (new Route)->__invoke($definition));
    }
}
