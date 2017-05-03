<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\ViewModel;
use Mvc5\Plugins\View;
use Mvc5\Plugins\Service;

class ViewModelController
{
    /**
     *
     */
    use View {
        model as public;
        view as public;
    }
    use Service;

    /**
     *
     */
    const VIEW_MODEL = ViewModel::class;

    /**
     *
     */
    const TEMPLATE = 'home';
}
