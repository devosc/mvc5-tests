<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

use Mvc5\Resolver\Dispatch as Base;

class Dispatch
    extends Base
{
    /**
     * @return array
     */
    public function argsTest()
    {
        return $this->args();
    }
}
