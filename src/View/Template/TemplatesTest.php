<?php
/**
 *
 */

namespace Mvc5\Test\View\Template;

use Mvc5\Test\Test\TestCase;

class TemplatesTest
    extends TestCase
{
    /**
     *
     */
    function test_template()
    {
        $templates = new Templates;

        $templates->templates(['bar' => 'baz']);

        $this->assertEquals('baz', $templates->template('bar'));
    }

    /**
     *
     */
    function test_template_not_exist()
    {
        $templates = new Templates;

        $this->assertEquals(null, $templates->template('foo'));
    }

    /**
     *
     */
    function test_templates_empty()
    {
        $templates = new Templates;

        $this->assertEquals([], $templates->templates());
    }

    /**
     *
     */
    function test_templates_not_empty()
    {
        $templates = new Templates;

        $this->assertEquals(['bar' => 'baz'], $templates->templates(['bar' => 'baz']));
    }
}
