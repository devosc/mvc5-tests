<?php
/**
 *
 */

namespace Mvc5\Test\Route\Definition;

use Mvc5\Route\Definition\Build as _Build;

class Build
{
    /**
     *
     */
    use _Build {
        build         as public;
        definition    as public;
        children      as public;
        create        as public;
        createDefault as public;
    }
}
