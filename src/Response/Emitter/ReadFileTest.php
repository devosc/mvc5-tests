<?php
/**
 *
 */

namespace Mvc5\Test\Response\Callback;

use Mvc5\Response\Emitter\ReadFile;
use Mvc5\Test\Test\TestCase;

class ReadFileTest
    extends TestCase
{
    /**
     *
     */
    function test_emit()
    {
        $emitter = new ReadFile(__DIR__ . '/test.txt');

        $emitter->emit();

        $this->assertEquals('Hello!', trim($this->getActualOutput()));
    }
}