<?php

namespace Mvc5\Test\Route\Definition;

use Mvc5\Route\Definition\Regex as Base;

class Regex
{
    /**
     *
     */
    use Base;

    /**
     * @param array $tokens
     * @param array $constraints
     * @param string $delimiter
     * @return string
     */
    public function regexTest(array $tokens, array $constraints = [], $delimiter = '/')
    {
        return $this->regex($tokens, $constraints, $delimiter);
    }
}
