<?php
/**
 *
 */

namespace Mvc5\Test\Response\Callback;

use Mvc5\Response\Emitter\Callback;
use Mvc5\Test\Test\TestCase;

class CallbackTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $emitter = new Callback(function() { return 'Hello!'; });

        $emitter->emit();

        $this->assertEquals('Hello!', $this->getActualOutput());
    }
}
