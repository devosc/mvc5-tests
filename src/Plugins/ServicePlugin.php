<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugins\Service;

class ServicePlugin
{
    /**
     *
     */
    use Service {
        call    as public;
        param   as public;
        plugin  as public;
        shared  as public;
        trigger as public;
    }
}
