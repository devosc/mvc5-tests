<?php
/**
 *
 */

namespace Mvc5\Test\Plugin\Config;

use Mvc5\Plugin\Config\Hydrator;
use Mvc5\Test\Test\TestCase;

class HydratorTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $mock = $this->getCleanMockForTrait(Hydrator::class, ['__construct'], ['foo', []]);

        $this->assertInternalType('object', $mock);
    }
}
