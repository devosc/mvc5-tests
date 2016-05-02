<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class ArgumentsTest
    extends TestCase
{
    /**
     *
     */
    function test_arguments()
    {
        $resolver = new Resolver;

        $this->assertEquals(['child'], $resolver->arguments(['child'], []));

        $this->assertEquals(['parent'], $resolver->arguments([], ['parent']));

        $this->assertEquals(['child', 'parent'], $resolver->arguments(['child'], ['parent']));

        $this->assertEquals(
            ['child' => 'foo', 'parent' => 'baz'],
            $resolver->arguments(['child' => 'foo'], ['child' => 'bar', 'parent' => 'baz'])
        );
    }
}
