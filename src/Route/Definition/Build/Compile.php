<?php

namespace Mvc5\Test\Route\Definition\Build;

use Mvc5\Route\Definition\Build\Compile as CompileBase;
use Mvc5\Test\Test\TestCase;

class Compile
    extends TestCase
{
    /**
     *
     */
    use CompileBase;

    /**
     * @param $tokens
     * @param $args
     * @param $defaults
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function testCompile($tokens, $args, $defaults)
    {
        return $this->compile($tokens, $args, $defaults);
    }
}
