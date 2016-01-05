<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ArgumentsTest
    extends TestCase
{
    /**
     *
     */
    public function test_arguments()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['arguments', 'argumentsTest']);

        $this->assertEquals(['child'], $mock->argumentsTest(['child'], []));

        $this->assertEquals(['parent'], $mock->argumentsTest([], ['parent']));

        $this->assertEquals(['child', 'parent'], $mock->argumentsTest(['child'], ['parent']));

        $this->assertEquals(
            ['child' => 'foo', 'parent' => 'baz'],
            $mock->argumentsTest(['child' => 'foo'], ['child' => 'bar', 'parent' => 'baz'])
        );
    }
}
