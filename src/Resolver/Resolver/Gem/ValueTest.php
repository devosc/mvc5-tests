<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\App;
use Mvc5\Plugin\Value;
use Mvc5\Test\Test\TestCase;

class ValueTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $this->assertEquals('foo', (new App)->plugin(new Value('foo')));
    }
}
