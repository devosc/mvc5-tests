<?php
/**
 *
 */

namespace Mvc5\Test\Cookie\Config;

use Mvc5\Cookie\Config\Cookies as _Cookies;

class Cookies
{
    use _Cookies;

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
        return $this->cookies;
    }

    /**
     * @return mixed
     */
    function defaults()
    {
        return $this->defaults;
    }
}
