<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

use Mvc5\Resolver\Alias as Base;

abstract class Alias
{
    /**
     *
     */
    use Base;

    /**
     * @param string $name
     * @return string
     */
    public function aliasTest($name)
    {
        return $this->alias($name);
    }
}
