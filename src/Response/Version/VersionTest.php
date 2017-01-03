<?php
/**
 *
 */

namespace Mvc5\Test\Version;

use Mvc5\Arg;
use Mvc5\Http\Request\Config as Request;
use Mvc5\Http\Response\Config as Response;
use Mvc5\Response\Version;
use Mvc5\Test\Test\TestCase;

class VersionTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $version = new Version;

        $response = $version(new Request([Arg::VERSION => '1.1']), new Response);

        $this->assertEquals('1.1', $response[Arg::VERSION]);
    }
}
