<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugins\Service;
use Mvc5\Plugins\Url;

class UrlPlugin
{
    /**
     *
     */
    use Service;
    use Url;

    /**
     * @param $url
     * @return mixed
     */
    function __invoke($url)
    {
        return $this->url($url);
    }
}
