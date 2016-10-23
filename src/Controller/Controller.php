<?php
/**
 *
 */

namespace Mvc5\Test\Controller;

use Mvc5\Plugin;
use Mvc5\Service;

class Controller
    implements Service
{
    /**
     *
     */
    use Plugin;

    function __invoke()
    {
        return $this->call('web');
    }
}
