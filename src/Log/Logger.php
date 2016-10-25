<?php
/**
 *
 */

namespace Mvc5\Test\Log;

use Mvc5\Log\Logger as _Logger;

class Logger
    extends _Logger
{
    /**
     * @return \Exception|mixed
     */
    function message()
    {
        return $this->message;
    }
}
