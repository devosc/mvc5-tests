<?php
/**
 *
 */

namespace Mvc5\Test\Controller;

use Mvc5\Arg;
use Mvc5\Controller\Exception;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class Test
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        /** @var Exception|Mock $mock */

        $exception = new \Exception;
        $model     = [Arg::EXCEPTION => $exception];

        $mock = $this->getCleanMock(Exception::class, ['__invoke'], [[]]);

        $this->assertTrue($model == $mock->__invoke($exception));
    }
}
