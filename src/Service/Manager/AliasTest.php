<?php

namespace Mvc5\Test\Service\Manager;

use Mvc5\Service\Manager\Alias;
use Mvc5\Test\Test\TestCase;

class AliasTest
    extends TestCase
{
    /**
     *
     */
    public function test_alias()
    {
        $mock = $this->getCleanMockForTrait(Alias::class, ['alias']);

        $this->assertEquals(null, $mock->alias('foo'));
    }

    /**
     *
     */
    public function test_alias_exists()
    {
        $mock = $this->getCleanMockForTrait(Alias::class, ['alias', 'aliases']);

        $mock->aliases(['foo' => 'bar']);

        $this->assertEquals('bar', $mock->alias('foo'));
    }

    /**
     *
     */
    public function test_aliases()
    {
        $mock = $this->getCleanMockForTrait(Alias::class, ['aliases']);

        $this->assertEquals(null, $mock->aliases([]));
    }
}
