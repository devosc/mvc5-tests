<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\FileInclude;
use Mvc5\Test\Resolver\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class FileIncludeTest
    extends TestCase
{
    /**
     *
     */
    public function test_gem_file_include()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $plugin = new FileInclude(__DIR__ . '/../Model/config.inc.php');

        $this->assertEquals(['foo' => 'bar'], $mock->gemTest($plugin));
    }
}
