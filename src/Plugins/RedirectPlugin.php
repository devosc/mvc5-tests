<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugin;
use Mvc5\Plugins\Redirect;

class RedirectPlugin
{
    /**
     *
     */
    use Plugin;
    use Redirect;

    /**
     * @return mixed
     */
    function __invoke()
    {
        return $this->redirect('/');
    }
}
