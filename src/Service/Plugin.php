<?php
/**
 *
 */

namespace Mvc5\Test\Service;

use Mvc5\Service\Plugin as Base;

class Plugin
{
    /**
     *
     */
    use Base {
        call    as public;
        param   as public;
        plugin  as public;
        trigger as public;
    }

    /**
     * @param $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
