<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Unresolvable;

use Mvc5\App;
use Mvc5\Resolver\Unresolvable;
use Mvc5\Test\Test\TestCase;

class UnresolvableTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $this->expectExceptionMessage('Unresolvable plugin: foo');

        (new Unresolvable)->__invoke('foo');
    }

    /**
     *
     */
    function test_plugin()
    {
        $this->expectExceptionMessage('Unresolvable plugin: foo');

        Unresolvable::plugin('foo');
    }

    /**
     *
     */
    function test_unresolvable_plugin()
    {
        $this->expectExceptionMessage('Unresolvable plugin: ' . Plugin::class);

        (new App)->plugin(new Plugin);
    }
}
