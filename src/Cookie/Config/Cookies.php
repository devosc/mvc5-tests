<?php
/**
 *
 */

namespace Mvc5\Test\Cookie\Config;

use Mvc5\Cookie\Config\Cookies as Config;

class Cookies
{
    use Config;

    /**
     * @return array
     */
    function config()
    {
        return $this->config;
    }

    /**
     * @return mixed
     */
    function container()
    {
        return $this->container;
    }

    /**
     * @return mixed
     */
    function defaults()
    {
        return $this->defaults;
    }
}
