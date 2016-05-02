<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Route\Match\Path as Base;

class Params
    extends Base
{
    /**
     * @param array $map
     * @param array $matches
     * @param array $defaults
     * @return array
     */
    function params(array $map, array $matches, array $defaults = [])
    {
        return parent::params($map, $matches, $defaults);
    }
}
