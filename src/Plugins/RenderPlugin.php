<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugins\Service;
use Mvc5\Plugins\Render;

class RenderPlugin
{
    /**
     *
     */
    use Render;
    use Service;

    /**
     * @param $template
     * @return mixed
     */
    function __invoke($template)
    {
        return $this->render($template);
    }
}
