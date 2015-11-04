<?php

namespace Mvc5\Test\Service\Config\Invoke;

use Mvc5\Service\Config\Invoke\Invoke;
use Mvc5\Test\Test\TestCase;

class InvokeTest
    extends TestCase
{
    /**
     *
     */
    public function test_args()
    {
        $mock = $this->getCleanMock(Invoke::class, ['args'], ['foo', ['foo']]);

        $this->assertEquals(['foo'], $mock->args());
    }

    /**
     *
     */
    public function test_config()
    {
        $mock = $this->getCleanMock(Invoke::class, ['config'], ['foo']);

        $this->assertEquals('foo', $mock->config());
    }
}
