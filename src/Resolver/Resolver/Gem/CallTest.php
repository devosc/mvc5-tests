<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\Call;
use Mvc5\Test\Resolver\Resolver\Resolver;
use Mvc5\Test\Resolver\Resolver\Model\CallObject;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class CallTest
    extends TestCase
{
    /**
     *
     */
    public function test_gem_call_named()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $call = new Call(CallObject::class, ['foo' => 'foo']);

        $this->assertEquals('foo', $mock->gemTest($call, ['bar' => 'bar']));
    }

    /**
     *
     */
    public function test_gem_call_not_named()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $call = new Call(CallObject::class, ['bar']);

        $this->assertEquals('foo', $mock->gemTest($call, ['foo']));
    }
}
