<?php

namespace Mvc5\Test\Service\Config\Form;

use Mvc5\Service\Config\Form\Form;
use Mvc5\Test\Test\TestCase;

class FormTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $this->assertInstanceOf(Form::class, new Form('foo'));
    }
}
