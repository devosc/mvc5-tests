<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Form;
use Mvc5\Test\Test\TestCase;

class FormTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $this->assertInstanceOf(Form::class, new Form('foo'));
    }
}
