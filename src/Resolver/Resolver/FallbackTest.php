<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Arg;
use Mvc5\Event;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class FallbackTest
    extends TestCase
{
    /**
     *
     */
    public function test_fallback_exists()
    {
        $resolver = new Resolver;

        $resolver->services([Arg::EVENT_MODEL => Event::class]);

        $invokable = $resolver->fallback('foo');

        $this->assertInstanceOf(Event::class, $invokable);
    }

    /**
     *
     */
    public function test_fallback_exception()
    {
        $resolver = new Resolver;

        $this->setExpectedException(\RuntimeException::class, 'Unresolvable plugin: foo');

        $resolver->fallback('foo');
    }
}
