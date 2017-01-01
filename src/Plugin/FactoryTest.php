<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Factory;
use Mvc5\Test\Test\TestCase;

class FactoryTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $factory = new Factory('foo');

        $this->assertEquals('foo', $factory->name());
        $this->assertEquals('factory', $factory->parent());
    }
}
