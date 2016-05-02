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
    function test_params()
    {
        $params = new Params;

        $this->assertEquals(1, count($params->params([['param', 'author']])));
    }
}
