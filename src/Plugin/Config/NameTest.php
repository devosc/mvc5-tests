<?php
/**
 *
 */

namespace Mvc5\Test\Plugin\Config;

use Mvc5\Plugin\Config\Name;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class NameTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        /** @var Name|Mock $mock */

        $mock = $this->getCleanMockForTrait(Name::class, ['__construct']);

        $mock->__construct(['foo']);
    }

    /**
     *
     */
    public function test_name()
    {
        /** @var Name|Mock $mock */

        $mock = $this->getCleanMockForTrait(Name::class, ['name'], ['foo']);

        $this->assertEquals('foo', $mock->name());
    }
}
