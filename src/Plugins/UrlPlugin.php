<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugins\Service;
use Mvc5\Plugins\Url;

final class UrlPlugin
{
    /**
     *
     */
    use Service;
    use Url {
        url as public;
    }
}
