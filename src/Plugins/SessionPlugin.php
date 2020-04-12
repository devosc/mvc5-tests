<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugins\Service;
use Mvc5\Plugins\Session;

final class SessionPlugin
{
    /**
     *
     */
    use Service;
    use Session {
        session as public;
    }
}
