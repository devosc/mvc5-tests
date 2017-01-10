<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugin;
use Mvc5\Plugins\User;

class UserPlugin
{
    /**
     *
     */
    use Plugin;
    use User {
        user as public;
    }
}
