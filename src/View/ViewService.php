<?php
/**
 *
 */

namespace Mvc5\Test\View;

use Mvc5\View\Model as ViewModel;
use Mvc5\View\Model\Service;

class ViewService
    implements Service
{
    /**
     *
     */
    use ViewModel;

    /**
     *
     */
    const VIEW_MODEL = Model::class;

    /**
     *
     */
    const TEMPLATE_NAME = 'foobar';
}
