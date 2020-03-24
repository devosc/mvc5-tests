<?php
/**
 *
 */

namespace Mvc5\Test\Template;

use Mvc5\Template\Model;
use Mvc5\Test\Test\TestCase;

use const Mvc5\TEMPLATE_MODEL;

class ModelTest
    extends TestCase
{
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
        $model = new TemplateModel(['bar' => 'baz']);

        $this->assertEquals('foo', $model->template());
        $this->assertEquals('baz', $model->get('bar'));
    }

    /**
     *
     */
    function test_template_const()
    {
        $model = new TemplateModel;

        $this->assertEquals('foo', $model->template());
    }

    /**
     *
     */
    function test_template_empty()
    {
        $model = new Model;

        $this->assertNull($model->template());
    }

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
    function test_with_template()
    {
        $model = new Model('foo');

        $result = $model->withTemplate('bar');

        $this->assertNotSame($result, $model);
        $this->assertEquals('foo', $model->template());
        $this->assertEquals('bar', $result->template());
    }

    /**
     *
     */
    function test_with_vars()
    {
        $vars = ['bar' => 'baz'];

        $model = new Model('foo');

        $result = $model->with($vars);

        $this->assertNotSame($result, $model);
        $this->assertEquals('foo', $model->template());
        $this->assertEquals('foo', $result->template());
        $this->assertEquals([TEMPLATE_MODEL => 'foo'], $model->vars());
        $this->assertEquals([TEMPLATE_MODEL => 'foo'] + $vars, $result->vars());
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
}
