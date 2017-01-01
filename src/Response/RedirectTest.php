<?php
/**
 *
 */

namespace Mvc5\Test\Response\Config;

use Mvc5\Http\Headers\Config as Headers;
use Mvc5\Response\Redirect;
use Mvc5\Test\Test\TestCase;

class RedirectTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $redirect = new Redirect('foobar', 302, ['foo' => 'bar']);

        $this->assertEquals(302, $redirect->status());
        $this->assertEquals(new Headers(['Location' => 'foobar', 'foo' => 'bar']), $redirect->headers());
    }
}
