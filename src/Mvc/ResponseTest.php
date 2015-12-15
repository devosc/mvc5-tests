<?php
/**
 *
 */

namespace Mvc5\Test\Mvc;

use Mvc5\Mvc\Response as MvcResponse;
use Mvc5\Response\Response;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ResponseTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        /** @var MvcResponse|Mock $mock */

        $mock = $this->getCleanAbstractMock(MvcResponse::class, ['__invoke']);

        $response = $this->getCleanMock(Response::class);

        $this->assertEquals($response, $mock->__invoke($response));
    }
}
