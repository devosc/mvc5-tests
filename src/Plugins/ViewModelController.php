<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugins\ViewModel as _ViewModel;
use Mvc5\Plugins\Service;

class ViewModelController
{
    /**
     *
     */
    use _ViewModel {
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
    const TEMPLATE_NAME = 'home';
}
