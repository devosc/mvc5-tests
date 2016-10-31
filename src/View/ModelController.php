<?php
/**
 *
 */

namespace Mvc5\Test\View;

use Mvc5\Model\ViewModel;
use Mvc5\View\Model as _ViewModel;

class ModelController
{
    /**
     *
     */
    use _ViewModel;

    /**
     * @param ViewModel $model
     */
    function __construct(ViewModel $model = null)
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
        return $this->model($vars, $template);
    }
}
