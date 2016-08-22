<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\Middleware as _Middleware;

class Middleware
    extends _Middleware
{
    /**
     * @return \Closure
     */
    function next()
    {
        return parent::next();
    }
}
