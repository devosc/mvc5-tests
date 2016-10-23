<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugin;
use Mvc5\Plugins\Config;

class ConfigPlugin
{
    /**
     *
     */
    use Config;
    use Plugin;

    /**
     * @return mixed
     */
    function __invoke()
    {
        return $this->config();
    }
}
