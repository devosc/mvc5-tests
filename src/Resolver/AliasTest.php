<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class AliasTest
    extends TestCase
{
    /**
     *
     */
    public function test_alias()
    {
        /** @var Alias|Mock $mock */

        $mock = $this->getCleanAbstractMock(Alias::class, ['alias', 'aliasTest']);

        $this->assertEquals(null, $mock->aliasTest('foo'));
    }

    /**
     *
     */
    public function test_alias_exists()
    {
        /** @var Alias|Mock $mock */

        $mock = $this->getCleanAbstractMock(Alias::class, ['alias', 'aliasTest', 'aliases']);

        $mock->aliases(['foo' => 'bar']);

        $this->assertEquals('bar', $mock->aliasTest('foo'));
    }

    /**
     *
     */
    public function test_aliases()
    {
        /** @var Alias|Mock $mock */

        $mock = $this->getCleanAbstractMock(Alias::class, ['aliases']);

        $this->assertEquals(['foo'], $mock->aliases(['foo']));
    }
}
