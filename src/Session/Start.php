<?php
/**
 *
 */

namespace Mvc5\Test\Session;

use Mvc5\Session\Session;
use Mvc5\Session\Start as _Start;

class Start
    extends _Start
{
    /**
     * @param Session $session
     * @return bool
     */
    function active(Session $session)
    {
        return parent::active($session);
    }

    /**
     * @param Session $session
     * @return Session
     */
    function register(Session $session)
    {
        return parent::register($session);
    }

    /**
     * @param Session $session
     * @param array $options
     * @return Session
     */
    function start(Session $session, array $options = [])
    {
        return parent::start($session, $options);
    }
}
