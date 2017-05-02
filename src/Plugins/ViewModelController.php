<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\ViewModel as _ViewModel;
use Mvc5\Plugins\ViewModel;
use Mvc5\Plugins\Service;

class ViewModelController
{
    /**
     *
     */
    use ViewModel {
        model as public;
        view as public;
    }
    use Service;

    /**
     *
     */
    const VIEW_MODEL = _ViewModel::class;

    /**
     *
     */
    const TEMPLATE_NAME = 'home';
}
