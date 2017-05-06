<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\ViewModel as _ViewModel;
use Mvc5\Plugin\ViewModel;
use Mvc5\Test\Test\TestCase;

class ViewModelTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $model = new ViewModel('foo', ['bar'], ['baz'], 'item');

        $this->assertEquals(_ViewModel::class, $model->name());
        $this->assertEquals(['template' => 'foo', 'vars' => ['bar']], $model->args());
        $this->assertEquals(['baz'], $model->calls());
        $this->assertEquals('item', $model->param());
        $this->assertFalse($model->merge());
    }
}
