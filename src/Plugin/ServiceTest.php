<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Link;
use Mvc5\Plugin\Service;
use Mvc5\Test\Test\TestCase;

class ServiceTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $service = new Service('foo', ['bar']);

        $this->assertEquals('foo', $service->name());
        $this->assertEquals(['bar'], $service->args());
        $this->assertEquals(['service' => new Link], $service->calls());
        $this->assertEquals('item', $service->param());
        $this->assertFalse($service->merge());
    }
}
