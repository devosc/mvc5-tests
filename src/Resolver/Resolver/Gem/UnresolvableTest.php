<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\App;
use Mvc5\Test\Resolver\Resolver\Model\Unresolvable;
use Mvc5\Test\Test\TestCase;
use RuntimeException;

class UnresolvableTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $this->setExpectedException(
            RuntimeException::class, 'Unresolvable plugin: Mvc5\Test\Resolver\Resolver\Model\Unresolvable'
        );

        (new App)->plugin(new Unresolvable);
    }
}
