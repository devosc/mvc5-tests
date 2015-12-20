<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Resolvable;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class SolveTest
    extends TestCase
{
    /**
     *
     */
    public function test_solve()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['solve', 'solveTest']);

        $resolvable = $this->getCleanMock(Resolvable::class);

        $mock->expects($this->once())
            ->method('resolve')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->solveTest($resolvable));
    }

    /**
     *
     */
    public function test_solve_not_resolvable()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['solve', 'solveTest']);

        $this->assertEquals('foo', $mock->solveTest('foo'));
    }

    /**
     *
     */
    public function test_solve_recursion()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['signal', 'solve', 'solveTest']);

        $resolvable = $this->getCleanMock(Resolvable::class);

        $mock->expects($this->any())
             ->method('resolve')
             ->will($this->returnArgument(0));

        $this->setExpectedException('RuntimeException');

        $mock->solveTest($resolvable);
    }
}
