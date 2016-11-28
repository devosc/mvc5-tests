<?php
/**
 *
 */

namespace Mvc5\Test\Service;

use TestView;

class AutowireAlias
{
    /**
     * @var TestView
     */
    protected $view;

    function __construct(TestView $view)
    {
        $this->view = $view;
    }

    /**
     * @return TestView
     */
    function view()
    {
        return $this->view;
    }
}
