<?php

namespace Mvc5\Test\Service\Config\Args;

use Mvc5\Service\Config\Args\Args;
use Mvc5\Test\Test\TestCase;

class ArgsTest
    extends TestCase
{
    /**
     *
     */
    public function test_config()
    {
        $mock = $this->getCleanMock(Args::class, ['config'], [['foo']]);

        $this->assertEquals(['foo'], $mock->config());
    }
}
