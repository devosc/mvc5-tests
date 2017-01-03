<?php
/**
 *
 */

namespace Mvc5\Test\Model;

use Mvc5\Arg;
use Mvc5\Model;
use Mvc5\Test\Test\TestCase;

class ModelTest
    extends TestCase
{
    /**
     *
     */
    function test_template_name()
    {
        $model = new Model('foo');

        $this->assertEquals('foo', $model->template());
    }

    /**
     *
     */
    function test_array_construct()
    {
        $model = new Model(['__template' => 'foo', 'bar' => 'baz']);

        $this->assertEquals('foo', $model->template());
        $this->assertEquals('baz', $model->get('bar'));
    }

    /**
     *
     */
    function test_array_construct_with_template_constant()
    {
        $model = new TestModel(['bar' => 'baz']);

        $this->assertEquals('foo', $model->template());
        $this->assertEquals('baz', $model->get('bar'));
    }

    /**
     *
     */
    function test_template_const()
    {
        $model = new TestModel;

        $this->assertEquals('foo', $model->template());
    }

    /**
     *
     */
    function test_empty_template()
    {
        $model = new Model;

        $this->assertEquals(null, $model->template());
    }

    /**
     *
     */
    function test_set_template()
    {
        $model = new Model;

        $this->assertEquals('foo', $model->template('foo'));
    }

    /**
     *
     */
    function test_vars_without_template()
    {
        $vars = ['foo' => 'bar'];

        $model = new Model(null, $vars);

        $this->assertEquals($vars, $model->vars());
    }

    /**
     *
     */
    function test_set_vars()
    {
        $vars = ['bar' => 'baz'];

        $model = new Model('foo');

        $this->assertEquals([Arg::TEMPLATE_MODEL => 'foo'] + $vars, $model->vars($vars));
    }
}
