<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Plugin\Gem\Gem;
use Mvc5\Resolvable;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class SolveTest
    extends TestCase
{
    /**
     *
     */
    public function test_solve_gem()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['solve', 'solveTest']);

        $mock->expects($this->once())
             ->method('gem')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->solveTest($this->getMock(Gem::class)));
    }

    /**
     *
     */
    public function test_solve_callback()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['solve', 'solveTest']);

        $resolvable = $this->getCleanMock(Resolvable::class);

        $this->assertEquals('foo', $mock->solveTest($resolvable, [], function() { return 'foo'; }));
    }

    /**
     *
     */
    public function test_solve_resolver()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['solve', 'solveTest']);

        $resolvable = $this->getCleanMock(Resolvable::class);

        $mock->expects($this->once())
             ->method('resolver')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->solveTest($resolvable));
    }
}
