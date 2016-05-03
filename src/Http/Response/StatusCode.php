<?php
/**
 *
 */

namespace Mvc5\Test\Http\Response;

use Mvc5\Http\Response\StatusCode as Base;

class StatusCode
{
    /**
     *
     */
    use Base {
        statusCodeText as public;
    }
}
