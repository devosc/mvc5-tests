<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\NullValue;
use Mvc5\Test\Test\TestCase;

final class NullValueTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $app = new App(['services' => ['foo' => null, 'bar' => new NullValue]]);

        $this->assertNull($app->plugin('bar'));

        $this->expectExceptionMessage('Class "foo" does not exist');

        $app->plugin('foo');
    }
}
