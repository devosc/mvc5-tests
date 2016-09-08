<?php
/**
 *
 */

namespace Mvc5\Test\Session\Config;

use Mvc5\Session\Config;

class Invalid
    extends Config
{
    /**
     * @param array $options
     * @return bool
     */
    function start(array $options = [])
    {
        return false;
    }
}
