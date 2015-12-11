<?php

namespace Mvc5\Test\Route;

use Mvc5\Route\Match as Base;

class Match
    extends Base
{

    /**
     * @return array
     */
    public function argsTest()
    {
        return $this->args();
    }
}
