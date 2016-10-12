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
        $tokens = new Tokens;

        $this->assertTrue(is_array($tokens->tokens('/:foo')));
    }

    /**
     *
     */
    function test_tokens_empty_arg()
    {
        $tokens = new Tokens;

        $this->assertEquals([['literal',':']], $tokens->tokens(':'));
    }

    /**
     *
     */
    function test_tokens_no_closing_bracket_exception()
    {
        $tokens = new Tokens;

        $this->setExpectedException('RuntimeException');

        $tokens->tokens('/:foo]');
    }

    /**
     *
     */
    function test_tokens_unbalanced_exception()
    {
        $tokens = new Tokens;

        $this->setExpectedException('RuntimeException');

        $tokens->tokens('/[:foo');
    }
}
