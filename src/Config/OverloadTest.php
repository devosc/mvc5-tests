<?php
/**
 *
 */

namespace Mvc5\Test\Config;

use Mvc5\Session\Model;
use Mvc5\Test\Test\TestCase;

class OverloadTest
    extends TestCase
{
    /**
     *
     */
    function test_get()
    {
        $model = new Model(['foo' => 'bar']);

        $this->assertEquals('bar', $model->get('foo'));
    }

    /**
     *
     */
    function test_get_not_set()
    {
        $model = new Model;

        $this->assertNull($model->get('foo'));
    }

    /**
     *
     */
    function test_get_overload_array()
    {
        $model = new Model;

        $model['foo']['bar'] = 'baz';

        $this->assertEquals(['bar' => 'baz'], $model->get('foo'));
    }

    /**
     *
     */
    function test_get_overload_config()
    {
        $model = new Model(new Model);

        $model['foo']['bar'] = 'baz';

        $this->assertEquals(['bar' => 'baz'], $model->get('foo'));
    }

    /**
     *
     */
    function test_offset_get()
    {
        $model = new Model;

        $model['foo'] = ['bar' => 'baz'];

        $this->assertEquals('baz', $model['foo']['bar']);

        $model['foo']['bar'] = 'bat';

        $this->assertEquals('bat', $model['foo']['bar']);
    }

    /**
     *
     */
    function test_offset_get_config_object()
    {
        $model = new Model(new Model(['foo' => ['bar' => 'baz']]));

        $this->assertEquals('baz', $model['foo']['bar']);

        $model['foo']['bar'] = 'bat';

        $this->assertEquals('bat', $model['foo']['bar']);
    }

    /**
     *
     */
    function test_property_get()
    {
        $model = new Model;

        $model->foo = ['bar' => 'baz'];

        $this->assertEquals('baz', $model->foo['bar']);

        $model->foo['bar'] = 'bat';

        $this->assertEquals('bat', $model->foo['bar']);
    }

    /**
     *
     */
    function test_property_get_config_object()
    {
        $model = new Model(new Model(['foo' => ['bar' => 'baz']]));

        $this->assertEquals('baz', $model->foo['bar']);

        $model->foo['bar'] = 'bat';

        $this->assertEquals('bat', $model->foo['bar']);
    }
}
