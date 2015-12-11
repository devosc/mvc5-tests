<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class CreateTest
    extends TestCase
{
    /**
     *
     */
    public function test_create()
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

        $this->assertInstanceOf(App::class, $sm->create('Foo'));
    }

    /**
     *
     */
    public function test_create_false()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['create']);

        $this->assertEquals(false, $mock->create(false));
    }

    /**
     *
     */
    public function test_create_string_configured()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['create']);

        $mock->expects($this->any())
            ->method('configured')
            ->willReturn(new \stdClass);

        $mock->expects($this->any())
            ->method('resolve')
            ->willReturn(new \stdClass);

        $this->assertInstanceOf(\stdClass::class, $mock->create('foo'));
    }

    /**
     *
     */
    public function test_create_string_with_no_configuration()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['create']);

        $mock->expects($this->once())
            ->method('build')
            ->willReturn('baz');

        $this->assertEquals('baz', $mock->create('foo'));
    }

    /**
     *
     */
    public function test_create_array()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['create']);

        $mock->expects($this->once())
            ->method('resolve')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->create([new \stdClass]));
    }

    /**
     *
     */
    public function test_create_closure()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['create']);

        $this->assertEquals(null, $mock->create(function() {}));
    }

    /**
     *
     */
    public function test_create_resolvable()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['create']);

        $this->assertEquals(null, $mock->create(function() {}));
    }

    /**
     *
     */
    public function test_create_composite()
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

        $this->assertEquals('foo/bar/baz', (new App($app))->create('Foo->Bar->Baz'));
    }
}
