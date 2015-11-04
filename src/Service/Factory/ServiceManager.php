<?php

namespace Mvc5\Test\Service\Factory;

use Mvc5\Service\Manager\ServiceManager as Base;
use Mvc5\Service\Manager\ManageService;

abstract class ServiceManager
    implements Base
{
    /**
     *
     */
    use ManageService;
}
