<?php

namespace Mvc5\Test\Application;

use Mvc5\Application\App;
use Mvc5\Application\Args;
use Mvc5\Test\Test\TestCase;

class ApplicationTest
    extends TestCase
{
    /**
     * @var array
     */
    protected $config = [
        Args::ALIAS    => [],
        Args::EVENTS   => [],
        Args::SERVICES => [
            Args::CONTAINER => []
        ]
    ];

    /**
     *
     */
    public function test__construct()
    {
        $this->assertEquals($this->config, (new App($this->config))->config());
    }
}
