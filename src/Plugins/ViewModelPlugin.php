<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugins\Service;
use Mvc5\Plugins\ViewModel;

class ViewModelPlugin
{
    /**
     *
     */
    use Service;
    use ViewModel {
        model as public;
        view as public;
    }
}
