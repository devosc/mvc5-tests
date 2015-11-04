<?php

namespace Mvc5\Test\Route\Definition\Build;

use Mvc5\Route\Definition\Build\Tokens as TokensBase;
use Mvc5\Test\Test\TestCase;
use RuntimeException;

class Tokens
    extends TestCase
{
    /**
     *
     */
    use TokensBase;

    /**
     * @param $subject
     * @param $delimiter
     * @return array
     * @throws RuntimeException
     */
    public function testTokens($subject, $delimiter = '/')
    {
        return $this->tokens($subject, $delimiter);
    }
}
