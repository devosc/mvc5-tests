<?php

namespace Mvc5\Test\Service\Provider;

use Mvc5\Service\Provider\Provider;
use Mvc5\Service\Resolver\Resolvable;
use Mvc5\Test\Test\TestCase;

class ProviderTest
    extends TestCase
{
    /**
     *
     */
    public function test_args()
    {
        $mock = $this->getCleanMock(ArgsProvider::class, ['args']);

        $this->assertTrue(is_array($mock->args()));
    }

    /**
     *
     */
    public function test__invoke()
    {
        $mock = $this->getCleanMock(Provider::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn('foo');

        $mock->expects($this->once())
             ->method('stop');

        $this->assertEquals('foo', $mock->__invoke(function() {}));
    }
    /**
     *
     */
    public function test_invoke_resolvable()
    {
        $resolvable = $this->getCleanMock(Resolvable::class);

        $mock = $this->getCleanMock(Provider::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn($resolvable);

        $this->assertEquals($resolvable, $mock->__invoke(function() {}));
    }
}
