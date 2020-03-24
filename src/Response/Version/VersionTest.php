<?php
/**
 *
 */

namespace Mvc5\Test\Version;

use Mvc5\Http\HttpRequest;
use Mvc5\Http\HttpResponse;
use Mvc5\Response\Version;
use Mvc5\Test\Test\TestCase;

use const Mvc5\VERSION;

class VersionTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $version = new Version;

        $response = $version(new HttpRequest([VERSION => '1.1']), new HttpResponse);

        $this->assertEquals('1.1', $response[VERSION]);
    }
}
