<?php
/**
 *
 */

namespace Mvc5\Test\Exception;

use Mvc5\Exception\Exception;

class PHPException
    extends \Exception
{
    /**
     *
     */
    use Exception;

    /**
     *
     */
    const INVALID_ARGUMENT = \InvalidArgumentException::class;

    /**
     *
     */
    const RUNTIME = \RuntimeException::class;
}
