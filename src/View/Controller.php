<?php
/**
 *
 */

namespace Mvc5\Test\View;

use Mvc5\ViewModel;
use Mvc5\View\Model;

class Controller
{
    /**
     *
     */
    use Model {
        model as public;
        view as public;
    }

    /**
     *
     */
    const VIEW_MODEL = ViewModel::class;

    /**
     *
     */
    const TEMPLATE_NAME = 'home';

    /**
     * @param null $model
     */
    function __construct($model = null)
    {
        $this->model = $model;
    }

    /**
     * @param array $vars
     * @param null $template
     * @return ViewModel
     */
    function __invoke(array $vars = [], $template = null)
    {
        return $this->view($template, $vars);
    }
}
