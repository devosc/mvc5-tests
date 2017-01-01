<?php
/**
 *
 */

namespace Mvc5\Test\View;

use Mvc5\Model;
use Mvc5\Model\ViewModel as _Model;
use Mvc5\View\Model as _ViewModel;

class Controller
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
    const TEMPLATE_NAME = 'home';

    /**
     * @param array $vars
     * @param null $template
     * @return _Model
     */
    function __invoke(array $vars = [], $template = null)
    {
        return $this->view($template, $vars);
    }
}
