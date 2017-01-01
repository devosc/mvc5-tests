<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Config;
use Mvc5\Plugin\Manager;
use Mvc5\Plugin\Param;
use Mvc5\Test\Test\TestCase;

class ManagerTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $manager = new Manager('foo');

        $calls = [
            'config'   => new Config,
            'services' => new Param('services'),
            'events'   => new Param('events')
        ];

        $this->assertEquals('foo', $manager->name());
        $this->assertEquals('manager', $manager->parent());
        $this->assertTrue($manager->merge());
        $this->assertEquals($calls, $manager->calls());
    }
}
