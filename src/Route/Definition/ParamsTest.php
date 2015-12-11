<?php

namespace Mvc5\Test\Route\Definition;

use Mvc5\Test\Test\TestCase;

class ParamsTest
    extends TestCase
{
    /**
     *
     */
    public function test_params()
    {
        /** @var Params $mock */

        $mock = $this->getCleanAbstractMock(Params::class, ['params', 'paramsTest']);

        $this->assertEquals(1, count($mock->paramsTest([['parameter', 'author']])));
    }
}
