<?php
/**
 *
 */

namespace Mvc5\Test\Route\Definition;

use Mvc5\Test\Test\TestCase;

class TokensTest
    extends TestCase
{
    /**
     *
     */
    function test_tokens()
    {
        $definition = new Tokens;

        $this->assertTrue(is_array($definition->tokens('/:foo')));
    }

    /**
     *
     */
    function test_tokens_empty_parameter_exception()
    {
        $definition = new Tokens;

        $this->setExpectedException('RuntimeException');

        $definition->tokens(':');
    }

    /**
     *
     */
    function test_tokens_no_closing_bracket_exception()
    {
        $definition = new Tokens;

        $this->setExpectedException('RuntimeException');

        $definition->tokens('/:foo]');
    }

    /**
     *
     */
    function test_tokens_unbalanced_exception()
    {
        $definition = new Tokens;

        $this->setExpectedException('RuntimeException');

        $definition->tokens('/[:foo');
    }
}
