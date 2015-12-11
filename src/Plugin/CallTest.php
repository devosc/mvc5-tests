<?php

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Call;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class CallTest
    extends TestCase
{
    /**
     *
     */
    public function test_args()
    {
        /** @var Call|Mock $mock */

        $mock = $this->getCleanMock(Call::class, ['args']);

        $this->assertEquals(null, $mock->args());
    }

    /**
     *
     */
    public function test_config()
    {
        /** @var Call|Mock $mock */

        $mock = $this->getCleanMock(Call::class, ['config'], [['foo']]);

        $this->assertEquals(['foo'], $mock->config());
    }
}
