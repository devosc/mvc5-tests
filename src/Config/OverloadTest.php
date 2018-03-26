<?php
/**
 *
 */

namespace Mvc5\Test\Config;

use Mvc5\Overload;
use Mvc5\Test\Test\TestCase;

class OverloadTest
    extends TestCase
{
    /**
     *
     */
    function test_get_not_overloaded()
    {
        $model = new Overload;

        $model->get('foo')['bar'] = 'baz';

        $this->assertNull($model->get('foo')['bar']);

        $model['foo']['bar'] = 'baz';

        $this->assertEquals('baz', $model->get('foo')['bar']);
    }

    /**
     *
     */
    function test_overload_offset_get()
    {
        $model = new Overload;

        $model['foo']['bar'] = 'baz';

        $this->assertEquals('baz', $model['foo']['bar']);
    }

    /**
     *
     */
    function test_overload_offset_get_config_object()
    {
        $model = new Overload(new Overload);

        $model['foo']['bar'] = 'baz';

        $this->assertEquals('baz', $model['foo']['bar']);
    }

    /**
     *
     */
    function test_overload_get_property()
    {
        $model = new Overload;

        $model->foo['bar'] = 'baz';

        $this->assertEquals('baz', $model->foo['bar']);
    }

    /**
     *
     */
    function test_overload_get_property_with_config_object()
    {
        $model = new Overload(new Overload);

        $model->foo['bar'] = 'baz';

        $this->assertEquals('baz', $model->foo['bar']);
    }
}
