<?php
/**
 *
 */

namespace Mvc5\Test\Service;

use Mvc5\App;
use Mvc5\Service\Context;
use Mvc5\Test\Test\TestCase;

/**
 * @runTestsInSeparateProcesses
 */
class ContextTest
    extends TestCase
{
    /**
     *
     */
    function test_constructor()
    {
        $app = new App;

        $context = new Context($app);

        $this->assertEquals($app, $context->service());
    }

    /**
     *
     */
    function test_bind()
    {
        $app = new App;

        Context::bind($app);

        $this->assertEquals($app, ServiceFacade::service());
    }

    /**
     *
     */
    function test_bind_exception()
    {
        $app = new App;

        Context::bind($app);

        $this->setExpectedException(\RuntimeException::class, 'Service already exists');

        Context::bind($app);
    }

    /**
     *
     */
    function test_service_does_not_exist()
    {
        $this->setExpectedException(\RuntimeException::class, 'Service does not exist');

        Context::service();
    }

    /**
     *
     */
    function test_invoke()
    {
        $app = new App;

        $context = new Context;

        $context($app);

        $this->assertEquals($app, $context->service());
    }
}
