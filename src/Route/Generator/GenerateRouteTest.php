<?php

namespace Mvc5\Test\Route\Generator;

use Mvc5\Route\Generator\GenerateRoute;
use Mvc5\Route\Generator\Generator;
use Mvc5\Test\Test\TestCase;

class GenerateRouteTest
    extends TestCase
{
    /**
     *
     */
    public function test_generate()
    {
        $generator = $this->getCleanMock(Generator::class);

        $generator->expects($this->once())
                  ->method('url')
                  ->willReturn('foo');

        $mock = $this->getCleanMockForTrait(GenerateRoute::class, ['generate', 'setRouteGenerator']);

        $mock->setRouteGenerator($generator);

        $this->assertEquals('foo', $mock->generate('baz', []));
    }
}
