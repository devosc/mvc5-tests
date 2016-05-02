<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\Copy;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class CopyTest
    extends TestCase
{
    /**
     *
     */
    function test_gem_copy()
    {
        $resolver = new Resolver;

        $object = new \stdClass;

        $copy = $resolver->gem(new Copy($object));

        $this->assertEquals($object, $copy);

        $this->assertFalse($object === $copy);
    }
}
