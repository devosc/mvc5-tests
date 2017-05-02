<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugins\Service;
use Mvc5\Plugins\User;

class UserPlugin
{
    /**
     *
     */
    use Service;
    use User {
        user as public;
    }
}
