<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Route\Match\Path as Base;

class PathParams
    extends Base
{
    /**
     * @param array $paramMap
     * @param array $matches
     * @return array
     */
    public function params(array $paramMap, array $matches)
    {
        return parent::params($paramMap, $matches);
    }
}
