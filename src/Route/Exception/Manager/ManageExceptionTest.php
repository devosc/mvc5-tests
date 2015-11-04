<?php

namespace Mvc5\Test\Route\Exception\Manager;

use Mvc5\Route\Exception\Manager\ManageException;
use Mvc5\Route\Exception\Manager\ExceptionManager;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;

class ManageExceptionTest
    extends TestCase
{
    /**
     *
     */
    public function test_exception()
    {
        $mock = $this->getCleanMockForTrait(ManageException::class, ['exception', 'setExceptionManager']);

        $em = $this->getCleanMock(ExceptionManager::class);

        $em->expects($this->once())
           ->method('exception')
           ->willReturn('foo');


        $mock->setExceptionManager($em);

        $route = $this->getCleanMock(Route::class);

        $this->assertEquals('foo', $mock->exception($route, new \Exception));
    }
}
