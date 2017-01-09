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
    function test_empty_arg()
    {
        $tokens = new Tokens;

        $this->assertEquals([['literal',':']], $tokens(':'));
    }

    /**
     *
     */
    function test_named_param()
    {
        $tokens = new Tokens;
        $this->assertEquals([['literal', '/'], ['param', '__foo__', '[^/]+']], $tokens('/{__foo__}'));
    }

    /**
     *
     */
    function test_no_closing_bracket_exception()
    {
        $tokens = new Tokens;

        $this->setExpectedException('RuntimeException', 'Found closing bracket without matching opening bracket');

        $tokens('/{foo}]');
    }

    /**
     *
     */
    function test_unbalanced_exception()
    {
        $tokens = new Tokens;

        $this->setExpectedException('RuntimeException', 'Found unbalanced brackets');

        $tokens('/[{foo}');
    }

    /**
     *
     */
    function test_with_expression()
    {
        $tokens = new Tokens(['foo' => 'bar']);

        $this->assertEquals([['param', '', 'bar']], $tokens('{:foo}'));
    }
}
