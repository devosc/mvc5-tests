<?php
/**
 *
 */

namespace Mvc5\Test\Plugin\Config;

use Mvc5\Arg;
use Mvc5\Test\Test\TestCase;

class ChildTest
    extends TestCase
{
    /**
     *
     */
    public function test_parent()
    {
        $child = new Child([Arg::PARENT => 'foo']);

        $this->assertEquals('foo', $child->parent());
    }
}
