<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\Plugin;
use Mvc5\Service\Service;
use Mvc5\Test\Test\TestCase;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    public function test_service_empty()
    {
        /** @var Plugin $mock */

        $mock = $this->getCleanMockForTrait(Plugin::class, ['service']);

        $this->assertEquals(null, $mock->service());
    }

    /**
     *
     */
    public function test_service_not_empty()
    {
        /** @var Plugin $mock */

        $mock = $this->getCleanMockForTrait(Plugin::class, ['service']);

        $service = $this->getCleanMock(Service::class);

        $this->assertEquals($service, $mock->service($service));
    }
}
