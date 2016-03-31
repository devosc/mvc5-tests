<?php
/**
 *
 */

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
        $definition = new Params;

        $this->assertEquals(1, count($definition->params([['parameter', 'author']])));
    }
}
