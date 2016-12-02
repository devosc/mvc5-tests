<?php
/**
 *
 */

namespace Mvc5\Test\Service\Config;

use Mvc5\Config\Configuration;
use Mvc5\Service\Config\Container as _Container;

class Container
    implements Configuration
{
    /**
     *
     */
    use _Container {
        stored as public;
    }
}
