<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugin;
use Mvc5\Plugins\Response;

class ResponsePlugin
{
    /**
     *
     */
    use Plugin;
    use Response {
        json as public;
        redirect as public;
        response as public;
    }
}
