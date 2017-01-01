<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\NullValue;
use Mvc5\Test\Test\TestCase;

class NullValueTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $this->assertNull((new NullValue)->config());
    }
}
