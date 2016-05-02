<?php
/**
 *
 */

namespace Mvc5\Test\Cookie\Config;

use Mvc5\Cookie\Config\Sender as Config;
use Mvc5\Cookie\Cookies as CookieJar;

class Sender
    implements CookieJar
{
    use Config {
        setCookie as public;
    }
}
