<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Config;
use Mvc5\Plugin\Args;
use Mvc5\Plugin\Plugin;
use Mvc5\Plugin\Value;
use Mvc5\Test\Resolver\Resolver;
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

        $plugin = new Plugin(Config::class, [new Args(['foo' => new Value('bar')])]);

        $this->assertEquals(new Config(['foo' => 'bar']), $resolver->gem($plugin));
    }

    /**
     *
     */
    public function test_provide_no_parent_with_args()
    {
        $resolver = new Resolver;

        $plugin = new Plugin(Config::class, [[new Value('bar')]]);

        $this->assertEquals(new Config(['baz']), $resolver->gem($plugin, [['baz']]));
    }

    /**
     *
     */
    public function test_provide_no_parent_with_named_args()
    {
        $resolver = new Resolver;

        $plugin = new Plugin(Config::class, [['foo' => new Value('bar')]]);

        $this->assertEquals(new Config(['foo' => 'baz']), $resolver->gem($plugin, [['foo' => 'baz']]));
    }

    /**
     *
     */
    public function test_provide_same_parent()
    {
        $resolver = new Resolver;

        $config = new Plugin(Config::class, ['foo' => 'bar']);

        $resolver->configure(Config::class, $config);

        $this->assertEquals(new Config(['foo' => 'baz']), $resolver->provide($config, [['foo' => 'baz']]));
    }

    /**
     *
     */
    public function test_provide_not_parent_type_config()
    {
        $resolver = new Resolver;

        $config = new Plugin(Config::class, ['foo' => 'bar']);

        $resolver->configure(Config::class, Config::class);

        $this->assertEquals(new Config(['foo' => 'baz']), $resolver->provide($config, [['foo' => 'baz']]));
    }

    /**
     *
     */
    public function test_provide_with_merge()
    {
        $resolver = new Resolver;

        $resolver->configure('foo', new Plugin(Config::class, ['foo' => new Value('bar')]));

        $config = new Plugin('foo');

        $this->assertEquals(new Config(['foo' => 'baz']), $resolver->provide($config, [['foo' => 'baz']]));
    }
}
