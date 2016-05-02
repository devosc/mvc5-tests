<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\Middleware as Base;

class Middleware
    extends Base
{
    /**
     * @return \Closure
     */
    function next()
    {
        return parent::next();
    }
}
