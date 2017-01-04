<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\App;
use Mvc5\Plugin\FileInclude;
use Mvc5\Test\Test\TestCase;

class FileIncludeTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $plugin = new FileInclude(__DIR__ . '/../Model/config.inc.php');

        $this->assertEquals(['foo' => 'bar'], (new App)->plugin($plugin));
    }
}
