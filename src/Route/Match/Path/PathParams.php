<?php

namespace Mvc5\Test\Route\Match\Path;

use Mvc5\Route\Match\Path\Path as Base;

class PathParams
    extends Base
{
    public function testParams(array $paramMap, array $matches)
    {
        return $this->params($paramMap, $matches);
    }
}
