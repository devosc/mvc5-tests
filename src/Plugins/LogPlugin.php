<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugins\Log;
use Mvc5\Plugins\Service;

final class LogPlugin
{
    /**
     *
     */
    use Log {
        log as public;
    }
    use Service;
}
