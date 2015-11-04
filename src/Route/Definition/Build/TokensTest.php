<?php

namespace Mvc5\Test\Route\Definition\Build;

use Mvc5\Test\Test\TestCase;

class TokensTest
    extends TestCase
{
    /**
     *
     */
    public function test_tokens()
    {
        $mock = $this->getCleanMock(Tokens::class, ['tokens', 'testTokens']);
        $this->assertTrue(is_array($mock->testTokens('/:foo')));
    }

    /**
     *
     */
    public function test_tokens_empty_parameter_exception()
    {
        $mock = $this->getCleanMock(Tokens::class, ['tokens', 'testTokens']);

        $this->setExpectedException('RuntimeException');

        $mock->testTokens(':');
    }

    /**
     *
     */
    public function test_tokens_no_closing_bracket_exception()
    {
        $mock = $this->getCleanMock(Tokens::class, ['tokens', 'testTokens']);

        $this->setExpectedException('RuntimeException');

        $mock->testTokens('/:foo]');
    }

    /**
     *
     */
    public function test_tokens_unbalanced_exception()
    {
        $mock = $this->getCleanMock(Tokens::class, ['tokens', 'testTokens']);

        $this->setExpectedException('RuntimeException');

        $mock->testTokens('/[:foo');
    }
}
