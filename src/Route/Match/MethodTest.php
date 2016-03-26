<?php

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Response\Error\MethodNotAllowed;
use Mvc5\Route\Match\Method;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Definition\Config as Definition;
use Mvc5\Test\Test\TestCase;

class MethodTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        $definition = new Definition([Arg::METHOD => ['GET']]);
        $method     = new Method;
        $route      = new Route([Arg::METHOD => 'GET']);

        $this->assertEquals($route, $method($route, $definition));
    }

    /**
     *
     */
    public function test_invoke_not_matched()
    {
        $definition = new Definition([Arg::METHOD => 'GET']);
        $method     = new Method;
        $route      = new Route([Arg::METHOD => 'POST']);

        $this->assertInstanceOf(MethodNotAllowed::class, $method($route, $definition));
    }
}
