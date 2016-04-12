<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Config;
use Mvc5\Plugin\Plugin;
use Mvc5\Plugin\Value;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Resolver\Resolver\Model\Provide as Model;
use Mvc5\Test\Test\TestCase;

class ProvideTest
    extends TestCase
{
    /**
     *
     */
    public function test_provide_no_parent()
    {
        $resolver = new Resolver;

        $plugin = new Plugin(Model::class, [new Value('bar')]);

        $this->assertEquals(new Model('bar'), $resolver->gem($plugin));
    }

    /**
     *
     */
    public function test_provide_no_parent_with_args()
    {
        $resolver = new Resolver;

        $plugin = new Plugin(Model::class, [new Value('bar')]);

        $this->assertEquals(new Model('baz'), $resolver->gem($plugin, ['baz']));
    }

    /**
     *
     */
    public function test_provide_no_parent_with_named_args()
    {
        $resolver = new Resolver;

        $plugin = new Plugin(Model::class, ['a' => new Value('bar'), 'b' => 'bat']);

        $this->assertEquals(new Model('foo', 'bat'), $resolver->gem($plugin, ['a' => 'foo']));
    }

    /**
     *
     */
    public function test_provide_same_parent()
    {
        $resolver = new Resolver;

        $model = new Plugin(Model::class, ['a' => 'a', 'c' => new Value('c')]);

        $resolver->configure(Model::class, $model);

        $this->assertEquals(new Model('a1', 'b1', 'c'), $resolver->gem($model, ['a' => 'a1', 'b' => 'b1']));
    }

    /**
     *
     */
    public function test_provide_not_parent_type_plugin()
    {
        $resolver = new Resolver;

        $config = new Plugin(Model::class, ['a' => 'a', 'b' => new Value('b')]);

        $resolver->configure(Model::class, Model::class);

        $this->assertEquals(new Model('a1', 'b'), $resolver->gem($config, ['a' => 'a1']));
    }

    /**
     *
     */
    public function test_provide_with_merge()
    {
        $resolver = new Resolver;

        $resolver->configure('foo', new Plugin(Model::class, ['a' => new Value('a'), 'b' => new Value('b')]));

        $config = new Plugin('foo', ['a' => new Value('a1')]);

        $this->assertEquals(new Model('a1', 'b', 'c'), $resolver->gem($config, ['c' => 'c']));
    }
}
