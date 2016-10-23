<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugin;
use Mvc5\Plugins\Log;

class LogPlugin
{
    /**
     *
     */
    use Log;
    use Plugin;

    /**
     * @return mixed
     */
    function __invoke()
    {
        return $this->log('Hello!');
    }
}
