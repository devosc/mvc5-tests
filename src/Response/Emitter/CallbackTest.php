<?php
/**
 *
 */

namespace Mvc5\Test\Response\Emitter;

use Mvc5\Response\Emitter\Callback;
use Mvc5\Test\Test\TestCase;

final class CallbackTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $emitter = new Callback(fn() => 'Hello!');

        $emitter->emit();

        $this->assertEquals('Hello!', $this->getActualOutput());
    }
}
