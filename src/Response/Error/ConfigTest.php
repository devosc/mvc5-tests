<?php
/**
 *
 */

namespace Mvc5\Test\Response\Error;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ConfigTest
    extends TestCase
{
    /**
     *
     */
    public function test_code()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMock(Config::class, ['code']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->code());
    }

    /**
     *
     */
    public function test_description()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMock(Config::class, ['description']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->description());
    }

    /**
     *
     */
    public function test_errors()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMock(Config::class, ['errors']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn([]);

        $this->assertEquals([], $mock->errors());
    }

    /**
     *
     */
    public function test_message()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMock(Config::class, ['message']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->message());
    }

    /**
     *
     */
    public function test_status()
    {
        /** @var Config|Mock $mock */

        $mock = $this->getCleanMock(Config::class, ['status']);

        $mock->expects($this->once())
            ->method('offsetGet')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->status());
    }
}
