<?php
/**
 *
 */

namespace Mvc5\Test\Session;

use Mvc5\Session\PHPSession;

class Invalid
    extends PHPSession
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
