<?php

namespace Mvc5\Test\Route\Definition;

use Mvc5\Route\Definition\Compile as Base;
use Mvc5\Test\Test\TestCase;

class Compile
    extends TestCase
{
    /**
     *
     */
    use Base;

    /**
     * @param $tokens
     * @param $args
     * @param $defaults
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function compileTest($tokens, $args, $defaults)
    {
        return $this->compile($tokens, $args, $defaults);
    }
}
