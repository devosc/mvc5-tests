<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Shared;
use Mvc5\Test\Test\TestCase;

class SharedTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $this->assertInstanceOf(Shared::class, new Shared('foo'));
    }
}
