<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Model as Mvc5Model;
use Mvc5\Plugin\Model;
use Mvc5\Test\Test\TestCase;

class ModelTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $model = new Model('foo', ['bar'], ['baz'], 'item');

        $this->assertEquals(Mvc5Model::class, $model->name());
        $this->assertEquals(['template' => 'foo', 'config' => ['bar']], $model->args());
        $this->assertEquals(['baz'], $model->calls());
        $this->assertEquals('item', $model->param());
        $this->assertFalse($model->merge());
    }
}
