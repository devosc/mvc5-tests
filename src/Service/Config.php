<?php
/**
 *
 */

namespace Mvc5\Test\Service;

use Mvc5\Config\Configuration;
use Mvc5\Service\Config as Base;

class Config
    implements Configuration
{
    /**
     *
     */
    use Base {
        shared as public;
    }
}
