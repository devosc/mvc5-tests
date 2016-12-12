<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\App;
use Mvc5\Plugin\Scoped;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class ScopedTest
    extends TestCase
{
    /**
     *
     */
    function test_gem_scoped()
    {
        $resolver = new Resolver;

        $resolver->setScope(true);

        $scoped = $resolver->gem(new Scoped([$this, 'foo']));

        $this->assertInstanceOf(\Closure::class, $scoped);
        $this->assertEquals(Resolver::class, $scoped());
    }
    /**
     *
     */
    function test_gem_scoped_class()
    {
        $resolver = new Resolver;

        $resolver->setScope(new App);

        $scoped = $resolver->gem(new Scoped([$this, 'foo']));

        $this->assertInstanceOf(\Closure::class, $scoped);
        $this->assertEquals(App::class, $scoped());
    }

    /**
     * @return \Closure
     */
    function foo()
    {
        return function() {
            return get_class($this);
        };
    }
}
