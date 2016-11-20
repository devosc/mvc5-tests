<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

use Mvc5\Resolver\Unresolvable;
use Mvc5\Test\Test\TestCase;

class UnresolvableTest
    extends TestCase
{
    /**
     *
     */
    function test_plugin()
    {
        $this->setExpectedException(\RuntimeException::class, 'Unresolvable plugin: foo');

        Unresolvable::plugin('foo');
    }

    /**
     *
     */
    function test_invoke()
    {
        $this->setExpectedException(\RuntimeException::class);

        (new Unresolvable)->__invoke('foo');
    }
}
