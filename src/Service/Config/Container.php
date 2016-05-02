<?php
/**
 *
 */

namespace Mvc5\Test\Service\Config;

use Mvc5\Config\Configuration;
use Mvc5\Service\Config\Container as Base;

class Container
    implements Configuration
{
    /**
     *
     */
    use Base {
        shared as public;
    }
}
