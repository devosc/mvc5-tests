<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\Plugin;
use Mvc5\Http\Request;
use Mvc5\Http\Response;
use Mvc5\Service;

class MiddlewareController
    implements Service
{
    /**
     *
     */
    use Plugin;

    /**
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return mixed
     */
    function __invoke(Request $request, Response $response, callable $next)
    {
        return $this->call($next, [$request, $response]);
    }
}
