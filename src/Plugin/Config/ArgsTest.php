<?php
/**
 *
 */

namespace Mvc5\Test\Plugin\Config;

use Mvc5\Plugin\Config\Args;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ArgsTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        /** @var Args|Mock $mock */

        $mock = $this->getCleanMockForTrait(Args::class, ['__construct']);

        $mock->__construct(['foo']);
    }

    /**
     *
     */
    public function test_args()
    {
        /** @var Args|Mock $mock */

        $mock = $this->getCleanMockForTrait(Args::class, ['args']);

        $this->assertEquals(null, $mock->args());
    }
}
