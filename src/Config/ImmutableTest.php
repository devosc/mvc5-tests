<?php
/**
 *
 */

namespace Mvc5\Test\Config;

use Mvc5\Immutable;
use Mvc5\Test\Test\TestCase;

class ImmutableTest
    extends TestCase
{
    /**
     *
     */
    function test_offset_set()
    {
        $config = new Immutable;

        $this->setExpectedException(\Exception::class, 'Invalid operation: object cannot be modified');

        $config['foo'] = 'bar';
    }

    /**
     *
     */
    function test_property_set()
    {
        $config = new Immutable;

        $this->setExpectedException(\Exception::class, 'Invalid operation: object cannot be modified');

        $config->foo = 'bar';
    }
}
