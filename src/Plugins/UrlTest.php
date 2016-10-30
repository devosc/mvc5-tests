<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\App;
use Mvc5\Test\Test\TestCase;

class UrlTest
    extends TestCase
{
    /**
     *
     */
    function test_url()
    {
        $config = ['services' => ['url' => function() { return function($url) { return $url; }; }]];

        $plugin = new UrlPlugin(new App($config));

        $this->assertEquals('foo', $plugin('foo'));
    }
}
