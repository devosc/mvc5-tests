<?php

namespace Mvc5\Test\Route\Definition\Build;

use Mvc5\Route\Definition\Build\Regex as RegexBase;
use Mvc5\Test\Test\TestCase;

class Regex
    extends TestCase
{
    /**
     *
     */
    use RegexBase;

    /**
     * @param array $tokens
     * @param array $constraints
     * @param string $delimiter
     * @return string
     */
    public function testRegex(array $tokens, array $constraints = [], $delimiter = '/')
    {
        return $this->regex($tokens, $constraints, $delimiter);
    }
}
