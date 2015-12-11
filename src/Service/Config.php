<?php
/**
 *
 */

namespace Mvc5\Test\Service;

use Mvc5\Service\Config as Base;

class Config
{
    /**
     *
     */
    use Base;

    /**
     * @param string $name
     * @return mixed
     */
    public function sharedTest($name)
    {
        return $this->shared($name);
    }
}
