<?php
/**
 *
 */

namespace Mvc5\Test\Service;

use Mvc5\Arg;
use Mvc5\Config;

class Container
    extends Config
    implements \Mvc5\Service\Container
{
    /**
     *
     */
    use \Mvc5\Service\Config\Container {
        configured as public;
    }

    /**
     * @param array|Config $config
     */
    function __construct($config = [])
    {
        parent::__construct($config);

        isset($config[Arg::CONTAINER])
            && $this->container = $config[Arg::CONTAINER];

        isset($config[Arg::SERVICES])
            && $this->services = $config[Arg::SERVICES];
    }
}
