<?php
/**
 *
 */

namespace Mvc5\Test\View;

use Mvc5\Model as Mvc5Model;
use Mvc5\View\Model as ViewModel;

class Controller
{
    /**
     *
     */
    use ViewModel;

    /**
     *
     */
    const VIEW_MODEL = Mvc5Model::class;

    /**
     *
     */
    const TEMPLATE_NAME = 'home';
}
