<?php

namespace Mvc5\Test\Controller\Exception;

use Mvc5\Controller\Exception\Exception as BaseException;

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
