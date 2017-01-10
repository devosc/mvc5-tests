<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugin;
use Mvc5\Plugins\Log;

class LogPlugin
{
    /**
     *
     */
    use Log {
        log as public;
    }
    use Plugin;
}
