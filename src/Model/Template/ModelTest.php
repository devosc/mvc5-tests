<?php
/**
 *
 */

namespace Mvc5\Test\Model\Template;

use Mvc5\Arg;
use Mvc5\Model as Mvc5Model;
use Mvc5\Test\Test\TestCase;

class ModelTest
    extends TestCase
{
    /**
     *
     */
    function test_construct_template()
    {
        $model = new Model('foo');

        $this->assertEquals('foo', $model->template());
    }

    /**
     *
     */
    function test_construct_template_const()
    {
        $model = new Model;

        $this->assertEquals('baz', $model->template());
    }

    /**
     *
     */
    function test_template()
    {
        $model = new Mvc5Model;

        $this->assertEquals(null, $model->template());
    }

    /**
     *
     */
    function test_template_set()
    {
        $model = new Mvc5Model;

        $this->assertEquals('foo', $model->template('foo'));
    }

    /**
     *
     */
    function test_vars()
    {
        $vars = ['foo' => 'bar'];

        $model = new Mvc5Model(null, $vars);

        $this->assertEquals($vars, $model->vars());
    }

    /**
     *
     */
    function test_vars_set()
    {
        $vars = ['bar' => 'baz'];

        $model = new Mvc5Model('foo', $vars);

        $this->assertEquals([Arg::TEMPLATE_MODEL => 'foo'] + $vars, $model->vars($vars));
    }

    /**
     *
     */
    function test_get()
    {
        $vars = ['foo' => 'bar'];

        $model = new Mvc5Model(null, $vars);

        $this->assertEquals('bar', $model->foo);
    }

    /**
     *
     */
    function test_isset()
    {
        $vars = ['foo' => 'bar'];

        $model = new Mvc5Model(null, $vars);

        $this->assertEquals(true, isset($model->foo));
    }

    /**
     *
     */
    function test_set()
    {
        $model = new Mvc5Model;

        $this->assertEquals('bar', $model->foo = 'bar');
    }

    /**
     *
     */
    function test_unset()
    {
        $vars = ['foo' => 'bar'];

        $model = new Mvc5Model(null, $vars);

        $this->assertTrue(isset($model->foo));

        unset($model->foo);

        $this->assertFalse(isset($model->foo));
    }
}
