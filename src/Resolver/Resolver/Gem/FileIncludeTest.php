<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\FileInclude;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class FileIncludeTest
    extends TestCase
{
    /**
     *
     */
    public function test_gem_file_include()
    {
        $resolver = new Resolver;

        $plugin = new FileInclude(__DIR__ . '/../Model/config.inc.php');

        $this->assertEquals(['foo' => 'bar'], $resolver->gem($plugin));
    }
}
