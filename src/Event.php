<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\Event as Base;

class Event
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
