<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

use Mvc5\Resolver\Exception;
use Mvc5\Test\Test\TestCase;

class ExceptionTest
    extends TestCase
{
    /**
     *
     */
    public function test_invoke()
    {
        $this->setExpectedException(\RuntimeException::class);

        (new Exception)->__invoke('foo');
    }
}
