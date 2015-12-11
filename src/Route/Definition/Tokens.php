<?php

namespace Mvc5\Test\Route\Definition;

use Mvc5\Route\Definition\Tokens as Base;

class Tokens
{
    /**
     *
     */
    use Base;

    /**
     * @param $subject
     * @param $delimiter
     * @return array
     * @throws \RuntimeException
     */
    public function tokensTest($subject, $delimiter = '/')
    {
        return $this->tokens($subject, $delimiter);
    }
}
