<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Plugin\SignalArgs;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class VariadicTest
    extends TestCase
{
    /**
     *
     */
    public function test_variadic_args()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['variadic', 'variadicTest']);

        $this->assertEquals(['foo'], $mock->variadicTest([new SignalArgs(['foo'])]));
    }

    /**
     *
     */
    public function test_variadic_not_args()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['variadic', 'variadicTest']);

        $this->assertEquals(['foo'], $mock->variadicTest(['foo']));
    }
}
