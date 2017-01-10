<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugins\Service;
use Mvc5\Plugins\Render;

class RenderPlugin
{
    /**
     *
     */
    use Render {
        render as public;
    }
    use Service;
}
