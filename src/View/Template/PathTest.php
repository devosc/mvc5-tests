<?php
/**
 *
 */

namespace Mvc5\Test\View\Template;

use Mvc5\Test\Test\TestCase;

class PathTest
    extends TestCase
{
    /**
     *
     */
    function test_path()
    {
        $paths = new Path;

        $paths->paths(['bar' => 'baz']);

        $this->assertEquals('baz', $paths->path('bar'));
    }

    /**
     *
     */
    function test_path_not_exist()
    {
        $paths = new Path;

        $this->assertNull($paths->path('foo'));
    }

    /**
     *
     */
    function test_paths_empty()
    {
        $paths = new Path;

        $this->assertEquals([], $paths->paths());
    }

    /**
     *
     */
    function test_paths_not_empty()
    {
        $paths = new Path;

        $this->assertEquals(['bar' => 'baz'], $paths->paths(['bar' => 'baz']));
    }
}
