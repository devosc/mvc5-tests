<?php

namespace Mvc5\Test\Route\Definition\Build;

use Mvc5\Route\Definition\Build\Params as ParamsBase;
use Mvc5\Test\Test\TestCase;

class Params
    extends TestCase
{
    /**
     *
     */
    use ParamsBase;

    /**
     * @param array $tokens
     * @return array
     */
    public function testParams(array $tokens)
    {
        return $this->params($tokens);
    }
}
