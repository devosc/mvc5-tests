<?php

namespace Mvc5\Test\Route\Definition;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class TokensTest
    extends TestCase
{
    /**
     *
     */
    public function test_tokens()
    {
        /** @var Tokens|Mock $mock */

        $mock = $this->getCleanAbstractMock(Tokens::class, ['tokens', 'tokensTest']);

        $this->assertTrue(is_array($mock->tokensTest('/:foo')));
    }

    /**
     *
     */
    public function test_tokens_empty_parameter_exception()
    {
        /** @var Tokens|Mock $mock */

        $mock = $this->getCleanAbstractMock(Tokens::class, ['tokens', 'tokensTest']);

        $this->setExpectedException('RuntimeException');

        $mock->tokensTest(':');
    }

    /**
     *
     */
    public function test_tokens_no_closing_bracket_exception()
    {
        /** @var Tokens|Mock $mock */

        $mock = $this->getCleanAbstractMock(Tokens::class, ['tokens', 'tokensTest']);

        $this->setExpectedException('RuntimeException');

        $mock->tokensTest('/:foo]');
    }

    /**
     *
     */
    public function test_tokens_unbalanced_exception()
    {
        /** @var Tokens|Mock $mock */

        $mock = $this->getCleanAbstractMock(Tokens::class, ['tokens', 'tokensTest']);

        $this->setExpectedException('RuntimeException');

        $mock->tokensTest('/[:foo');
    }
}
