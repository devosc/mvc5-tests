<?php

namespace Mvc5\Test\Route\Definition\Build;

use Mvc5\Test\Test\TestCase;

class ParamsTest
    extends TestCase
{
    /**
     *
     */
    public function test_params()
    {
        $mock = $this->getCleanMock(Params::class, ['params', 'testParams']);

        $this->assertEquals(1, count($mock->testParams([['parameter', 'author']])));
    }
}
