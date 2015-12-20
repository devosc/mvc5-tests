<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\App;
use Mvc5\Test\Test\TestCase;

class AppTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        /** @var App $mock */

        $mock = $this->getCleanMock(App::class, ['config'], [['foo']]);

        $this->assertEquals(['foo'], $mock->config());
    }
}
