<?php

namespace Mvc5\Test\Service\Provider;

use Mvc5\Service\Provider\Resolver;
use Mvc5\Test\Test\TestCase;
use RuntimeException;

class ResolverTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        $this->setExpectedException(RuntimeException::class);

        (new Resolver)->__invoke(new Resolvable);
    }
}
