<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Config;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class GetTest
    extends TestCase
{
    /**
     *
     */
    public function test_get_shared()
    {
        $resolver = new Resolver;

        $resolver->set('foo', 'bar');

        $this->assertEquals('bar', $resolver->get('foo'));
    }

    /**
     *
     */
    public function test_get_plugin()
    {
        $resolver = new Resolver;

        $this->assertEquals(new Config, $resolver->get(Config::class));
    }
}
