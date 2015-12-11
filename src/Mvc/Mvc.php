<?php
/**
 *
 */

namespace Mvc5\Test\Mvc;

use Mvc5\Mvc\Mvc as Base;

class Mvc
{
    /**
     *
     */
    use Base;

    /**
     * @return array
     */
    public function argsTest()
    {
        return $this->args();
    }
}
