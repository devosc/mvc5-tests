<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugin;
use Mvc5\Plugins\Flash;

class FlashPlugin
{
    /**
     *
     */
    use Flash {
        flash as public;
    }
    use Plugin;
}
