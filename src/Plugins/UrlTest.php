<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\App;
use Mvc5\Test\Test\TestCase;

final class UrlTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $config = ['services' => ['url' => fn() => fn($url) => $url]];

        $plugin = new UrlPlugin(new App($config));

        $this->assertEquals('foo', $plugin->url('foo'));
    }
}
