<?php

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Invokable;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class InvokableTest
    extends TestCase
{
    /**
     *
     */
    public function test_config()
    {
        /** @var Invokable|Mock $mock */

        $mock = $this->getCleanMock(Invokable::class, ['config'], ['foo']);

        $this->assertEquals('foo', $mock->config());
    }

    /**
     *
     */
    public function test_args()
    {
        /** @var Invokable|Mock $mock */

        $mock = $this->getCleanMock(Invokable::class, ['args'], [null, ['foo']]);

        $this->assertEquals(['foo'], $mock->args());
    }
}
