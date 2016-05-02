<?php
/**
 *
 */

namespace Mvc5\Test\Config;

use Mvc5\Config\Config;
use Mvc5\Config\Configuration;
use Mvc5\Config\PropertyAccess;

class PropertyConfig
    implements Configuration
{
    /**
     *
     */
    use Config;
    use PropertyAccess;
}
