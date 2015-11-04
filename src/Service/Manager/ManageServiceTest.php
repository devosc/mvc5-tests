<?php

namespace Mvc5\Test\Service\Manager;

use Mvc5\Application\App;
use Mvc5\Service\Manager\ManageService;
use Mvc5\Test\Test\TestCase;

class ManageServiceTest
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
        $mock = $this->getCleanMockForTrait(ManageService::class, ['create']);

        $this->assertEquals(false, $mock->create(false));
    }

    /**
     *
     */
    public function test_create_string_configured()
    {
        $mock = $this->getCleanMockForTrait(ManageService::class, ['create']);

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
        $mock = $this->getCleanMockForTrait(ManageService::class, ['create']);

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
        $mock = $this->getCleanMockForTrait(ManageService::class, ['create']);

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
        $mock = $this->getCleanMockForTrait(ManageService::class, ['create']);

        $this->assertEquals(null, $mock->create(function() {}));
    }

    /**
     *
     */
    public function test_create_resolvable()
    {
        $mock = $this->getCleanMockForTrait(ManageService::class, ['create']);

        $this->assertEquals(null, $mock->create(function() {}));
    }

    /**
     *
     */
    public function test_create_composite()
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

        $baz = $config + ['bar' => 'baz'];

        $bar = [
            'alias'     => [
                'config' => $baz
            ],
            'container' => [],
            'events'    => [],
            'services'  => [
                'Baz' => App::class,
                'Service\Container' => []
            ]
        ];

        $app['alias']['config'] = [
            'alias'     => [
                'config' => $bar
            ],
            'container' => [],
            'events'    => [],
            'services'  => [
                'Bar' => App::class,
                'Service\Container' => []
            ]
        ];

        $app['services']['Foo'] = App::class;

        $this->assertEquals($baz, (new App($app))->create('Foo->Bar->Baz')->config());
    }

    /**
     *
     */
    public function test_get_initialize()
    {
        $mock = $this->getCleanMockForTrait(ManageService::class, ['get']);

        $mock->expects($this->once())
             ->method('service')
             ->willReturn(null);

        $mock->expects($this->any())
             ->method('initialize')
             ->will($this->returnArgument(0))
             ->willReturn('bar');

        $this->assertEquals('bar', $mock->get('foo'));
    }

    /**
     *
     */
    public function test_get()
    {
        $mock = $this->getCleanMockForTrait(ManageService::class, ['get']);

        $mock->expects($this->once())
             ->method('service')
             ->willReturn('bar');

        $this->assertEquals('bar', $mock->get('foo'));
    }

    /**
     *
     */
    public function test_plugin()
    {
        $mock = $this->getCleanMockForTrait(ManageService::class, ['plugin']);

        $mock->expects($this->once())
             ->method('resolve')
             ->willReturn('bar');

        $this->assertEquals('bar', $mock->plugin('foo'));
    }

    /**
     *
     */
    public function test_plugin_service()
    {
        $mock = $this->getCleanMockForTrait(ManageService::class, ['plugin']);

        $mock->expects($this->once())
             ->method('resolve')
             ->willReturn(null);

        $mock->expects($this->once())
             ->method('create')
             ->willReturn('bar');

        $this->assertEquals('bar', $mock->plugin('foo'));
    }
}
