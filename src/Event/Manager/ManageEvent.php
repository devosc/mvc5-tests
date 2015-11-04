<?php

namespace Mvc5\Test\Event\Manager;

use Mvc5\Event\Manager\ManageEvent as Base;

abstract class ManageEvent
{
    /**
     *
     */
    use Base;

    /**
     * @return array|\Traversable
     */
    public function testListeners()
    {
        return $this->listeners();
    }
}
