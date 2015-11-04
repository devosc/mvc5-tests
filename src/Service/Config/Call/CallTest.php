<?php

namespace Mvc5\Test\Service\Config\Call;

use Mvc5\Service\Config\Call\Call;
use Mvc5\Test\Test\TestCase;

class CallTest
    extends TestCase
{
    /**
     *
     */
    public function test_args()
    {
        $mock = $this->getCleanMock(Call::class, ['args']);

        $this->assertEquals(null, $mock->args());
    }

    /**
     *
     */
    public function test_config()
    {
        $mock = $this->getCleanMock(Call::class, ['config'], [['foo']]);

        $this->assertEquals(['foo'], $mock->config());
    }
}
