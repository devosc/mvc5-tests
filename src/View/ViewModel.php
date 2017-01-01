<?php
/**
 *
 */

namespace Mvc5\Test\View;

use Mvc5\Model;
use Mvc5\View\Model as _ViewModel;
use Mvc5\View\Model\Service;

class ViewModel
    implements Service
{
    /**
     *
     */
    use _ViewModel;

    /**
     *
     */
    const VIEW_MODEL = Model::class;

    /**
     *
     */
    const TEMPLATE_NAME = 'foobar';
}
