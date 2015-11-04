<?php

namespace Mvc5\Test\Route\Definition\Build;

use Mvc5\Route\Definition\RouteDefinition;
use Mvc5\Route\Definition\Url\Url;
use Mvc5\Test\Test\TestCase;

class UrlTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        $this->assertInstanceOf(RouteDefinition::class, (new Url)->__invoke(['route' => '/bar']));
    }
}
