<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    public function test_plugin()
    {
        $config = [
            'alias'     => [],
            'container' => [],
            'events'    => [],
            'services'  => [
                'Service\Container' => []
            ]
        ];

        $app = $config;

        $app['services']['Foo'] = App::class;

        $app['alias']['config'] = $config;

        $sm = new App($app);

        $this->assertInstanceOf(App::class, $sm->plugin('Foo'));
    }

    /**
     *
     */
    public function test_plugin_false()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['plugin']);

        $this->assertEquals(false, $mock->plugin(false));
    }

    /**
     *
     */
    public function test_plugin_string_configured()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['plugin']);

        $mock->expects($this->any())
            ->method('configured')
            ->willReturn(new \stdClass);

        $mock->expects($this->any())
            ->method('resolve')
            ->willReturn(new \stdClass);

        $this->assertInstanceOf(\stdClass::class, $mock->plugin('foo'));
    }

    /**
     *
     */
    public function test_plugin_string_with_no_configuration()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['plugin']);

        $mock->expects($this->once())
            ->method('build')
            ->willReturn('baz');

        $this->assertEquals('baz', $mock->plugin('foo'));
    }

    /**
     *
     */
    public function test_plugin_array()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['plugin']);

        $mock->expects($this->once())
            ->method('resolve')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->plugin([new \stdClass]));
    }

    /**
     *
     */
    public function test_plugin_closure()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['plugin']);

        $this->assertEquals(null, $mock->plugin(function() {}));
    }

    /**
     *
     */
    public function test_plugin_resolvable()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['plugin']);

        $this->assertEquals(null, $mock->plugin(function() {}));
    }

    /**
     *
     */
    public function test_plugin_composite()
    {
        $app = [
            'alias'     => [],
            'container' => [],
            'events'    => [],
            'services'  => [
                'Foo' => new Config(['Bar' => ['Baz' => 'foo/bar/baz']]),
                'container' => []
            ]
        ];

        $this->assertEquals('foo/bar/baz', (new App($app))->plugin('Foo->Bar->Baz'));
    }
}
