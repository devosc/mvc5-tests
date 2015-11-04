<?php

namespace Mvc5\Test\Route\Exception;

use Mvc5\Route\Exception\Exception as BaseException;

class ArgsException
    extends BaseException
{
    /**
     * @return array
     */
    public function args()
    {
        return parent::args();
    }
}
