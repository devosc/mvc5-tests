<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\Config;
use Mvc5\Iterator;

use Mvc5\Test\Test\TestCase;

final class IteratorTest
    extends TestCase
{
    /**
     *
     */
    function test_clone()
    {
        $config = new Config(['foo' => 'bar']);
        $iterator = new Iterator($config);

        $clone = clone $iterator;
        $config['foo'] = 'foobar';

        $this->assertEquals('foobar', $iterator->current());
        $this->assertEquals('bar', $clone->current());
    }
}
