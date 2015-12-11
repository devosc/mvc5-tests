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
    public function test_template()
    {
        /** @var Templates $mock */

        $mock = $this->getCleanAbstractMock(Templates::class, ['template', 'templateTest', 'templates']);

        $mock->templates(['bar' => 'baz']);

        $this->assertEquals('baz', $mock->templateTest('bar'));
    }

    /**
     *
     */
    public function test_template_not_exist()
    {
        /** @var Templates $mock */

        $mock = $this->getCleanAbstractMock(Templates::class, ['template', 'templateTest']);

        $this->assertEquals(null, $mock->templateTest('foo'));
    }

    /**
     *
     */
    public function test_templates_empty()
    {
        /** @var Templates $mock */

        $mock = $this->getCleanAbstractMock(Templates::class, ['templates']);

        $this->assertEquals([], $mock->templates());
    }

    /**
     *
     */
    public function test_templates_not_empty()
    {
        /** @var Templates $mock */

        $mock = $this->getCleanAbstractMock(Templates::class, ['templates']);

        $this->assertEquals(['bar' => 'baz'], $mock->templates(['bar' => 'baz']));
    }
}
