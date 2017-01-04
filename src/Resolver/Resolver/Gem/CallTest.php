<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\App;
use Mvc5\Plugin\Call;
use Mvc5\Test\Resolver\Resolver\Model\CallObject;
use Mvc5\Test\Test\TestCase;

class CallTest
    extends TestCase
{
    /**
     *
     */
    function test_named()
    {
        $call = new Call(CallObject::class, ['foo' => 'foo']);

        $this->assertEquals('foo', (new App)->plugin($call, ['bar' => 'bar']));
    }

    /**
     *
     */
    function test_not_named()
    {
        $call = new Call(CallObject::class, ['bar']);

        $this->assertEquals('foo', (new App)->plugin($call, ['foo']));
    }
}
