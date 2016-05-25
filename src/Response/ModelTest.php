<?php
/**
 *
 */

namespace Mvc5\Test\Response;

use Mvc5\Response\Config as Response;
use Mvc5\Response\Model;
use Mvc5\Test\Test\TestCase;

class ModelTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $model = new Model;

        $this->assertEquals(new Response('foo'), $model(new Response, 'foo'));
    }
}
