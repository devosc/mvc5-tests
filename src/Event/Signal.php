<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\Event\Signal as Base;

abstract  class Signal
{
    /**
     *
     */
    use Base;

    /**
     * @return array
     */
    public function argsTest()
    {
        return $this->args();
    }
}
