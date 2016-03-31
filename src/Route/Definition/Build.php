<?php
/**
 *
 */

namespace Mvc5\Test\Route\Definition;

use Mvc5\Route\Definition\Build as Base;

class Build
{
    /**
     *
     */
    use Base {
        build         as public;
        definition    as public;
        children      as public;
        create        as public;
        createDefault as public;
    }
}
