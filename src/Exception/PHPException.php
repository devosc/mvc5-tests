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
    const ERROR_EXCEPTION = \ErrorException::class;

    /**
     *
     */
    const EXCEPTION = \Exception::class;

    /**
     *
     */
    const INVALID_ARGUMENT = \InvalidArgumentException::class;

    /**
     *
     */
    const RUNTIME = \RuntimeException::class;
}
