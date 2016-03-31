<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class ParamTest
    extends TestCase
{
    /**
     *
     */
    public function test_param()
    {
        $resolver = new Resolver;

        $resolver->config(['foo' => ['bar' => 'baz']]);

        $this->assertEquals('baz', $resolver->param('foo.bar'));
    }
}
