<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Resolvable;
use Mvc5\Test\Resolver\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;
use RuntimeException;

class UnresolvableTest
    extends TestCase
{
    /**
     *
     */
    public function test_gem_unresolvable()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['signal', 'gem', 'gemTest']);

        $this->setExpectedException(RuntimeException::class);

        $mock->gemTest($this->getMock(Resolvable::class));
    }
}
