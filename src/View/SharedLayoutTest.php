<?php
/**
 *
 */

namespace Mvc5\Test\View;

use Mvc5\App;
use Mvc5\Test\Test\TestCase;
use Mvc5\View\SharedLayout;

final class SharedLayoutTest
    extends TestCase
{
    /**
     *
     */
    function test_shared_layout()
    {
        $layout = new SharedLayout;

        $this->assertSame($layout, $layout->with('foo', 'bar'));
        $this->assertSame($layout, $layout->without('foo'));
        $this->assertSame($layout, $layout->withService(new App));
    }
}
