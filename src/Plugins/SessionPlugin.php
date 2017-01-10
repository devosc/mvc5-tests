<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugin;
use Mvc5\Plugins\Session;

class SessionPlugin
{
    /**
     *
     */
    use Plugin;
    use Session {
        session as public;
    }
}
