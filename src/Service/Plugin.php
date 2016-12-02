<?php
/**
 *
 */

namespace Mvc5\Test\Service;

use Mvc5\Service\Plugin as _Plugin;

class Plugin
{
    /**
     *
     */
    use _Plugin {
        call    as public;
        param   as public;
        plugin  as public;
        shared  as public;
        trigger as public;
    }

    /**
     * @param $service
     */
    function __construct(Service $service)
    {
        $this->service = $service;
    }
}
