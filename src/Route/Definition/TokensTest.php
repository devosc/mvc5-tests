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

        $this->assertTrue(is_array($tokens('/{foo}')));
    }

    /**
     *
     */
    function test_tokens_empty_arg()
    {
        $tokens = new Tokens;

        $this->assertEquals([['literal',':']], $tokens(':'));
    }

    /**
     *
     */
    function test_tokens_no_closing_bracket_exception()
    {
        $tokens = new Tokens;

        $this->setExpectedException('RuntimeException');

        $tokens('/{foo}]');
    }

    /**
     *
     */
    function test_tokens_unbalanced_exception()
    {
        $tokens = new Tokens;

        $this->setExpectedException('RuntimeException');

        $tokens('/[{foo}');
    }

    /**
     *
     */
    function test_tokens_with_expression()
    {
        $tokens = new Tokens(['foo' => 'bar']);

        $this->assertEquals([['param', '', 'bar']], $tokens('{:foo}'));
    }
}
