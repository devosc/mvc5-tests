<?php
/**
 *
 */

namespace Mvc5\Test\Route\Definition;

use Mvc5\Route\Definition\Compile as Base;
use Mvc5\Test\Test\TestCase;

class Compile
    extends TestCase
{
    /**
     *
     */
    use Base {
        compile as public;
    }
}
