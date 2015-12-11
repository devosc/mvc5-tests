<?php

namespace Mvc5\Test\Url;

use Mvc5\Arg;
use Mvc5\Route\Definition;
use Mvc5\Route\Definition\Config;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class GeneratorTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $this->getCleanMock(Generator::class, [], [[]]);
    }

    /**
     *
     */
    public function test_config()
    {
        /** @var Generator $mock */

        $mock = $this->getCleanMock(Generator::class, ['config', 'configTest'], [[Arg::NAME => 'foo']]);

        $this->assertEquals([Arg::NAME => 'foo'], $mock->configTest('foo'));
    }

    /**
     *
     */
    public function test_config_child()
    {
        $definition = $this->getCleanMock(Definition::class, [], [[Arg::CHILDREN => ['foo' => 'bar']]]);

        $definition->expects($this->once())
                   ->method('child')
                   ->willReturn('baz');

        /** @var Generator $mock */

        $mock = $this->getCleanMock(Generator::class, ['config', 'configTest'], [$definition]);

        $this->assertEquals('baz', $mock->configTest('foo'));
    }

    /**
     *
     */
    public function test_name()
    {
        $definition = new Config(['name' => 'foo']);

        /** @var Generator $mock */

        $mock = $this->getCleanMock(Generator::class, ['name', 'nameTest'], [$definition]);

        $this->assertEquals('foo', $mock->nameTest('foo'));
    }

    /**
     *
     */
    public function test_name_not_exists()
    {
        $definition = new Config(['name' => 'foo']);

        /** @var Generator $mock */

        $mock = $this->getCleanMock(Generator::class, ['name', 'nameTest'], [$definition]);

        $this->assertEquals('foo/bar', $mock->nameTest('bar'));
    }

    /**
     *
     */
    public function test_url()
    {
        $definition = new Config(['name' => 'foo']);

        /** @var Generator|Mock $mock */

        $mock = $this->getCleanMock(Generator::class, ['url', 'urlTest'], [$definition]);

        $mock->expects($this->once())
            ->method('build')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->urlTest('foo'));
    }

    /**
     *
     */
    public function test_url_with_no_build()
    {
        $definition = new Config();

        /** @var Generator|Mock $mock */

        $mock = $this->getCleanMock(Generator::class, ['url', 'urlTest'], [$definition]);

        $mock->expects($this->once())
            ->method('build')
            ->willReturn('/');

        $this->assertEquals('/', $mock->urlTest(''));
    }

    /**
     *
     */
    public function test_generate()
    {
        $definition = $this->getCleanMock(Config::class);

        $definition->expects($this->once())
            ->method('tokens')
            ->willReturn([]);

        $definition->expects($this->once())
            ->method('defaults')
            ->willReturn([]);

        $definition->expects($this->once())
            ->method('wildcard')
            ->willReturn(true);

        $definition->expects($this->once())
            ->method('constraints')
            ->willReturn([]);

        /** @var Generator|Mock $mock */

        $mock = $this->getCleanMock(Generator::class, ['generate', 'generateTest']);

        $mock->expects($this->once())
            ->method('url')
            ->willReturn($definition);

        $mock->expects($this->once())
            ->method('config');

        $args = ['foo' => 'bar'];

        $this->assertEquals('/foo/bar', $mock->generateTest('foo', $args));
    }

    /**
     *
     */
    public function test_generate_no_definition_exception()
    {
        /** @var Generator|Mock $mock */

        $mock = $this->getCleanMock(Generator::class, ['generate', 'generateTest']);

        $mock->expects($this->once())
            ->method('url');

        $mock->expects($this->once())
            ->method('config');

        $args = ['foo' => 'bar'];

        $this->setExpectedException('Exception');

        $mock->generateTest('foo', $args);
    }

    /**
     *
     */
    public function test_generate_with_child()
    {
        $definition = $this->getCleanMock(Config::class);

        $definition->expects($this->once())
            ->method('tokens')
            ->willReturn([]);

        $definition->expects($this->once())
            ->method('defaults')
            ->willReturn([]);

        $definition->expects($this->once())
            ->method('wildcard')
            ->willReturn(true);

        $definition->expects($this->once())
            ->method('constraints')
            ->willReturn([]);

        $definition->expects($this->once())
            ->method('child');

        /** @var Generator|Mock $mock */

        $mock = $this->getCleanMock(Generator::class, ['generate', 'generateTest']);

        $mock->expects($this->once())
            ->method('url')
            ->willReturn($definition);

        $mock->expects($this->any())
            ->method('config');

        $args = ['foo' => 'bar'];

        $this->assertEquals('/foo/bar', $mock->generateTest('foo', $args, $definition));
    }

    /**
     *
     */
    public function test_invoke()
    {
        /** @var Generator|Mock $mock */

        $mock = $this->getCleanMock(Generator::class, ['__invoke']);

        $mock->expects($this->once())
            ->method('generate')
            ->willReturn('/foo/');

        $mock->expects($this->once())
            ->method('name');

        $this->assertEquals('/foo', $mock->__invoke('foo'));
    }

    /**
     *
     */
    public function test_invoke_no_path()
    {
        /** @var Generator|Mock $mock */

        $mock = $this->getCleanMock(Generator::class, ['__invoke']);

        $mock->expects($this->once())
            ->method('generate')
            ->willReturn('/');

        $mock->expects($this->once())
            ->method('name');

        $this->assertEquals('/', $mock->__invoke('foo'));
    }
}
