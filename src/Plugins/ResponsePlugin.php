<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugins\Response;
use Mvc5\Plugins\Service;

final class ResponsePlugin
{
    /**
     *
     */
    use Response {
        json as public;
        redirect as public;
        response as public;
    }
    use Service;
}
