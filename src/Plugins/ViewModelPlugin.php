<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugins\Service;
use Mvc5\Plugins\View;

class ViewModelPlugin
{
    /**
     *
     */
    use Service;
    use View {
        layout as public;
        model as public;
        view as public;
    }
}
