<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugins\Messages;
use Mvc5\Plugins\Service;

class MessagesPlugin
{
    /**
     *
     */
    use Messages {
        danger as public;
        info as public;
        message as public;
        messages as public;
        success as public;
        warning as public;
    }
    use Service;
}
