<?php

namespace Mvc5\Test\Route\Definition;

use Mvc5\Route\Definition\Params as Base;

class Params
{
    /**
     *
     */
    use Base;

    /**
     * @param array $tokens
     * @return array
     */
    public function paramsTest(array $tokens)
    {
        return $this->params($tokens);
    }
}
