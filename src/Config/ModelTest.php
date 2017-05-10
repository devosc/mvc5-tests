<?php
/**
 *
 */

namespace Mvc5\Test\Config;

use Mvc5\Model;
use Mvc5\Test\Test\TestCase;

class ModelTest
    extends TestCase
{
    /**
     *
     */
    function test_offset_set()
    {
        $config = new Model;

        $this->expectExceptionMessage('Invalid operation: object cannot be modified');

        $config['foo'] = 'bar';
    }

    /**
     *
     */
    function test_offset_unset()
    {
        $config = new Model;

        $this->expectExceptionMessage('Invalid operation: object cannot be modified');

        unset($config['foo']);
    }

    /**
     *
     */
    function test_property_set()
    {
        $config = new Model;

        $this->expectExceptionMessage('Invalid operation: object cannot be modified');

        $config->foo = 'bar';
    }

    /**
     *
     */
    function test_property_unset()
    {
        $config = new Model;

        $this->expectExceptionMessage('Invalid operation: object cannot be modified');

        unset($config->foo);
    }
}
