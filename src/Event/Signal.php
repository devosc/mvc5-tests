<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\Event\Signal as EventSignal;

class Signal
{
    /**
     *
     */
    use EventSignal {
        args as public;
    }
}
