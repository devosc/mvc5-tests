<?php
/**
 *
 */

namespace Mvc5\Test\Route\Definition;

use Mvc5\Test\Test\TestCase;

class ConstraintTest
    extends TestCase
{
    /**
     *
     */
    function test_constraint()
    {
        $constraint = new Constraint;

        $tokens = [['literal', '/'], ['param', 'home', '$']];

        $this->assertEquals(['home' => '$'], $constraint->constraint($tokens));
    }
}
