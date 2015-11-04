<?php

namespace Mvc5\Test\View;

use Mvc5\View\ViewTemplates;
use Mvc5\Test\Test\TestCase;

class ViewTemplatesTest
    extends TestCase
{
    /**
     *
     */
    public function test_template()
    {
        $mock = $this->getCleanMockForTrait(ViewTemplates::class, ['template', 'templates']);

        $mock->templates(['bar' => 'baz']);

        $this->assertEquals('baz', $mock->template('bar'));
    }

    /**
     *
     */
    public function test_template_not_exist()
    {
        $mock = $this->getCleanMockForTrait(ViewTemplates::class, ['template']);

        $this->assertEquals(null, $mock->template('foo'));
    }

    /**
     *
     */
    public function test_templates()
    {
        $mock = $this->getCleanMockForTrait(ViewTemplates::class, ['templates']);

        $this->assertEquals(null, $mock->templates(['bar' => 'baz']));
    }
}
