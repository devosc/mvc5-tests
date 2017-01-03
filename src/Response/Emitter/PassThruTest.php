<?php
/**
 *
 */

namespace Mvc5\Test\Response\Callback;

use Mvc5\Response\Emitter\PassThru;
use Mvc5\Test\Test\TestCase;

class PassThruTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $emitter = new PassThru('pwd');

        $emitter->emit();

        $this->assertEquals(\getcwd(), trim($this->getActualOutput()));
    }
}
