<?php
/**
 *
 */

namespace Mvc5\Test\Route;

use Mvc5\Arg;
use Mvc5\User\Model as User;
use Mvc5\Test\Test\TestCase;

class UserTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $user = new User([Arg::AUTHENTICATED => true, Arg::USERNAME => 'foo']);

        $this->assertEquals(true, $user[Arg::AUTHENTICATED]);
        $this->assertEquals('foo', $user[Arg::USERNAME]);
        $this->assertEquals(true, $user->authenticated());
        $this->assertEquals('foo', $user->username());
    }

    /**
     *
     */
    function test_empty()
    {
        $user = new User;

        $this->assertEquals(null, $user[Arg::AUTHENTICATED]);
        $this->assertEquals(null, $user[Arg::USERNAME]);
        $this->assertEquals(false, $user->authenticated());
        $this->assertEquals(null, $user->username());
    }
}
