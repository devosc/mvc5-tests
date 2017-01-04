<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\App;
use Mvc5\Plugin\Filter;
use Mvc5\Test\Test\TestCase;

class FilterTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $this->assertEquals('foo', (new App)->plugin(new Filter('foo', [function($foo) { return $foo; }])));
    }
}
