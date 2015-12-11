<?php
/**
 *
 */

namespace Mvc5\Test\View\Template;

use Mvc5\View\Template\Templates as Base;

abstract class Templates
{
    /**
     *
     */
    use Base;

    /**
     * @param string $name
     * @return string
     */
    public function templateTest($name)
    {
        return $this->template($name);
    }
}
