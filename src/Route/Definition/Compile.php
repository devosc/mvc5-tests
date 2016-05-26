<?php
/**
 *
 */

namespace Mvc5\Test\Route\Definition;

use Mvc5\Route\Definition\Compile as _Compile;
use Mvc5\Test\Test\TestCase;

class Compile
    extends TestCase
{
    /**
     *
     */
    use _Compile {
        compile as public;
    }
}
