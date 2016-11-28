<?php
/**
 *
 */

namespace Mvc5\Test\Service;

use Mvc5\Service\Facade;

class ServiceFacade
{
    /**
     *
     */
    use Facade
    {
        call as public;
        param as public;
        plugin as public;
        shared as public;
        service as public;
        trigger as public;
    }
}
