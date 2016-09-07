<?php
/**
 *
 */

namespace Mvc5\Test\Session;

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
