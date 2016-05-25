<?php
/**
 *
 */

namespace Mvc5\Test\Http\Status;

use Mvc5\Http\Status\ReasonPhrase as Base;

class ReasonPhrase
{
    /**
     *
     */
    use Base {
        statusReasonPhrase as public;
    }
}
