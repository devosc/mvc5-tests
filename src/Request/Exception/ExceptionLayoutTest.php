<?php
/**
 *
 */

namespace Mvc5\Test\Request\Exception;

use Mvc5\Request\Exception\ViewLayout;
use Mvc5\Test\Test\TestCase;

final class ExceptionLayoutTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $layout = new ViewLayout(new \Exception);
        $this->assertInstanceOf(\Exception::class, $layout->exception());
        $this->assertEquals('exception', $layout->template());
    }
}
