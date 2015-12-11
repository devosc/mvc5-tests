<?php

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Invoke;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class InvokeTest
    extends TestCase
{
    /**
     *
     */
    public function test_args()
    {
        /** @var Invoke|Mock $mock */

        $mock = $this->getCleanMock(Invoke::class, ['args'], ['foo', ['foo']]);

        $this->assertEquals(['foo'], $mock->args());
    }

    /**
     *
     */
    public function test_config()
    {
        /** @var Invoke|Mock $mock */

        $mock = $this->getCleanMock(Invoke::class, ['config'], ['foo']);

        $this->assertEquals('foo', $mock->config());
    }
}
