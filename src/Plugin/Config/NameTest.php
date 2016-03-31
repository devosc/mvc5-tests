<?php
/**
 *
 */

namespace Mvc5\Test\Plugin\Config;

use Mvc5\Plugin\Param as Name;
use Mvc5\Test\Test\TestCase;

class NameTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $this->assertInstanceOf(Name::class, new Name(null));
    }

    /**
     *
     */
    public function test_name()
    {
        $name = new Name('foo');

        $this->assertEquals('foo', $name->name());
    }
}
