<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Dependency;
use Mvc5\Test\Test\TestCase;

class DependencyTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $this->assertInstanceOf(Dependency::class, new Dependency('foo'));
    }
}
