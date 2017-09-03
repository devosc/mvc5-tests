<?php
/**
 *
 */

namespace Mvc5\Test\Session;

use Mvc5\Session\Config\PHPSession;
use Mvc5\Session\Session;

class Invalid
    implements Session
{
    /**
     *
     */
    use PHPSession;

    /**
     * @param array $options
     * @return bool
     */
    function start(array $options = []) : bool
    {
        return false;
    }
}
