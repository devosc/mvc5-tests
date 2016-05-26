<?php
/**
 *
 */

namespace Mvc5\Test\View\Template;

use Mvc5\Model\ViewModel;
use Mvc5\Model\Plugin;

class HomeModel
    implements ViewModel
{
    /**
     *
     */
    use Plugin;

    /**
     *
     */
    const TEMPLATE_NAME = __DIR__ . '/index.phtml';

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
