<?php
/**
 *
 */

namespace Mvc5\Test\Plugin\Config;

use Mvc5\Plugin\Config\Config;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ConfigTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMockForTrait(Config::class, ['__construct']);

        $mock->__construct(['foo']);
    }

    /**
     *
     */
    public function test_config()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMockForTrait(Config::class, ['config'], [['foo']]);

        $this->assertEquals(['foo'], $mock->config());
    }
}
