<?php
/**
 *
 */

namespace Mvc5\Test\Route\Definition;

use Mvc5\Route\Definition\Tokens as _Tokens;

final class Tokens
{
    /**
     *
     */
    use _Tokens;

    /**
     * @param array $expressions
     */
    function __construct(array $expressions = [])
    {
        $expressions && $this->expressions += $expressions;
    }

    /**
     * @param string $route
     * @param array $constraints
     * @return array
     * @throws \RuntimeException
     */
    function __invoke($route, array $constraints = [])
    {
        return $this->tokens($route, $constraints);
    }
}
