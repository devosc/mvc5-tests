<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugin;
use Mvc5\Plugins\Messages;

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
    use Plugin;
}
