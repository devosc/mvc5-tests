<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\FileInclude;
use Mvc5\Test\Test\TestCase;

final class FileIncludeTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $fileInclude = new FileInclude('foo');

        $this->assertEquals('foo', $fileInclude->config());
    }

    /**
     *
     */
    function test_plugin()
    {
        $fileInclude = new FileInclude(__DIR__ . '/config.inc.php');

        $this->assertEquals(['foo' => 'bar'], (new App)->plugin($fileInclude));
    }
}
