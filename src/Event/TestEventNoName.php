<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\Event\Event;
use Mvc5\Event\Signal;

class TestEventNoName
    implements Event
{
    /**
     *
     */
    use Signal;
}
