<?php

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Args;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ArgsTest
    extends TestCase
{
    /**
     *
     */
    public function test_config()
    {
        /** @var Args|Mock $mock */

        $mock = $this->getCleanMock(Args::class, ['config'], [['foo']]);

        $this->assertEquals(['foo'], $mock->config());
    }
}
