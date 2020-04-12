<?php
/**
 *
 */

namespace Mvc5\Test\Response\Emitter;

use Mvc5\Response\Emitter\PassThru;
use Mvc5\Test\Test\TestCase;

final class PassThruTest
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
