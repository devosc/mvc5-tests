<?php
/**
 *
 */

namespace Mvc5\Test\Cookie\Config;

use Mvc5\Cookie\Config\Container as Config;
use Mvc5\Cookie\Cookies as CookieJar;

class Container
    implements CookieJar
{
    use Config {
        cookie    as public;
        setCookie as public;
    }

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
    function defaults()
    {
        return $this->defaults;
    }
}
