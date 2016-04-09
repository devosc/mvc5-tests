<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class ProviderTest
    extends TestCase
{
    /**
     *
     */
    public function test_provider()
    {
        $resolver = new Resolver;

        $provider = function(){};

        $resolver->setProvider($provider);

        $this->assertTrue($provider === $resolver->provider());
    }
}
