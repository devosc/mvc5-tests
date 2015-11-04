<?php

namespace Mvc5\Test\Route\Exception;

use Mvc5\Route\Exception\Config;
use Mvc5\Test\Test\TestCase;

class ConfigTest
    extends TestCase
{
    /**
     *
     */
    public function test_exception()
    {
        $mock = $this->getCleanMock(Config::class, ['exception']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->exception());
    }

    /**
     *
     */
    public function test_route()
    {
        $mock = $this->getCleanMock(Config::class, ['route']);

        $mock->expects($this->once())
            ->method('get')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->route());
    }
}
