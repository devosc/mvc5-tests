<?php

namespace Mvc5\Test\Service\Config\ConfigLink;

use Mvc5\Service\Config\ConfigLink\ConfigLink;
use Mvc5\Test\Test\TestCase;

class ConfigLinkTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $this->assertInternalType('object', new ConfigLink);
    }
}
