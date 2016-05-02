<?php
/**
 *
 */

namespace Mvc5\Test\Mvc\Event;

use Mvc5\Mvc\Event\Model as EventModel;

class Model
{
    /**
     *
     */
    use EventModel {
        controller as public;
        model      as public;
        response   as public;
        request    as public;
    }
}
