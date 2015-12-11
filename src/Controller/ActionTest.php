<?php
/**
 *
 */

namespace Mvc5\Test\Controller;

use Mvc5\Controller\Action;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ActionTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        /** @var Action|Mock $mock */

        $mock = $this->getCleanMock(Action::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('action')
             ->willReturn('foo');

        $this->assertTrue('foo' == $mock->__invoke(function() {}));
    }
}
