<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Unresolvable;

use Mvc5\App;
use Mvc5\Resolver\Unresolvable;
use Mvc5\Test\Test\TestCase;
use RuntimeException;

class UnresolvableTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $this->setExpectedException(\RuntimeException::class, 'Unresolvable plugin: foo');

        (new Unresolvable)->__invoke('foo');
    }

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
    function test_unresolvable_plugin()
    {
        $this->setExpectedException(
            RuntimeException::class, 'Unresolvable plugin: ' . Plugin::class
        );

        (new App)->plugin(new Plugin);
    }
}
