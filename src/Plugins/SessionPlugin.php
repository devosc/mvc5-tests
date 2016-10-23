<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugin;
use Mvc5\Plugins\Session;

class SessionPlugin
{
    /**
     *
     */
    use Plugin;
    use Session;

    /**
     * @param $name
     * @return mixed
     */
    function __invoke($name = null)
    {
        return $this->session($name);
    }
}
