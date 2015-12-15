<?php
/**
 *
 */

namespace Mvc5\Test\Response;

use Mvc5\Response\Dispatch as Base;

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
