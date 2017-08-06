<?php
/**
 *
 */

namespace Mvc5\Test\Exception;

use Mvc5\Exception\Generator;

class PHPException
    extends \Exception
{
    /**
     *
     */
    use Generator;

    /**
     *
     */
    const DOMAIN = \DomainException::class;

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

    /**
     * @param $name
     * @param $args
     */
    static function __callStatic($name, $args)
    {
        static::raise(static::create($name, $args));
    }
}
