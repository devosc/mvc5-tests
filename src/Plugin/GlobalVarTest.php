<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\GlobalVar;
use Mvc5\Test\Test\TestCase;

class GlobalVarTest
    extends TestCase
{
    /**
     *
     */
    function test_global_var()
    {
        $GLOBALS['foo'] = 'bar';
        $this->assertEquals('bar', (new App)->plugin(new GlobalVar('foo')));
    }

    /**
     *
     */
    function test_global_var_not_set()
    {

        $this->assertNull((new App)->plugin(new GlobalVar('baz')));
    }
}
