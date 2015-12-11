<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Plugin\Plugin;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class MergeTest
    extends TestCase
{
    /**
     *
     */
    public function test_merge()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['merge', 'mergeTest']);

        $parent = new Plugin('foo', ['foo' => 'bar']);

        $config = new Plugin('bar', ['foo' => 'baz'], ['a' => 'b'], true);

        $this->assertInstanceOf(Plugin::class, $mock->mergeTest($parent, $config));
    }

    /**
     *
     */
    public function test_merge_no_parent_name()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['merge', 'mergeTest']);

        $mock->expects($this->once())
            ->method('resolve')
            ->willReturn('foo');

        $parent = new Plugin(null);

        $config = new Plugin('bar');

        $this->assertInstanceOf(Plugin::class, $mock->mergeTest($parent, $config));
    }

    /**
     *
     */
    public function test_merge_no_merge_parent_calls()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['merge', 'mergeTest']);

        $parent = new Plugin('foo');

        $config = new Plugin('bar', [], ['a' => 'b']);

        $this->assertInstanceOf(Plugin::class, $mock->mergeTest($parent, $config));
    }
}
