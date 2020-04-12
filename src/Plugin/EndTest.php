<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\Args;
use Mvc5\Plugin\End;
use Mvc5\Plugin\Call;
use Mvc5\Plugin\Value;
use Mvc5\Test\Test\TestCase;

final class EndTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $end = new End(
            new Call('@phpversion'),
            new Value('foo')
        );

        $this->assertEquals('@end', $end->config());
        $this->assertEquals([new Args([new Call('@phpversion'), new Value('foo')])], $end->args());
        $this->assertEquals('foo', (new App)->plugin($end));
    }
}
