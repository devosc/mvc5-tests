<?php
/**
 *
 */

namespace Mvc5\Test\View;

use Mvc5\ViewModel;

class HomeModel
    extends ViewModel
{
    /**
     *
     */
    const TEMPLATE = __DIR__ . '/index.phtml';

    /**
     *
     */
    private $title = 'Home';

    /**
     * @return string
     */
    private function title()
    {
        return $this->title;
    }
}
