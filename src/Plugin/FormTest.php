<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Form;
use Mvc5\Test\Test\TestCase;

final class FormTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $form = new Form('foo');

        $this->assertEquals('foo', $form->name());
        $this->assertEquals('form', $form->parent());
    }
}
