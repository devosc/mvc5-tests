<?php

namespace Mvc5\Test\Service\Config\Invokable;

use Mvc5\Service\Config\Invokable\Invokable;
use Mvc5\Test\Test\TestCase;

class InvokableTest
    extends TestCase
{
    /**
     *
     */
    public function test_config()
    {
        $mock = $this->getCleanMock(Invokable::class, ['config'], ['foo']);

        $this->assertEquals('foo', $mock->config());
    }
}
