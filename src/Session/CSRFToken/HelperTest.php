<?php
/**
 *
 */

namespace Mvc5\Test\Session\CSRFToken;

use Mvc5\App;
use Mvc5\Model;
use Mvc5\Plugin\Invokable;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Test\TestCase;

/**
 *
 */
class HelperTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $app = new App([
            'services' => [
                'csrf_token' => new Invokable(new Plugin('session->csrf_token')),
                'session' => new Model(['csrf_token' => 'foobar'])
            ]
        ]);

        $this->assertEquals('foobar', $app->csrf_token());
    }
}
