<?php
/**
 *
 */

namespace Mvc5\Test\User;

use Mvc5\User\Model as User;
use Mvc5\Test\Test\TestCase;

use const Mvc5\{ AUTHENTICATED, USERNAME };

final class UserTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $user = new User([AUTHENTICATED => true, USERNAME => 'foo']);

        $this->assertEquals(true, $user[AUTHENTICATED]);
        $this->assertEquals('foo', $user[USERNAME]);
        $this->assertEquals(true, $user->authenticated());
        $this->assertEquals('foo', $user->username());
    }

    /**
     *
     */
    function test_empty()
    {
        $user = new User;

        $this->assertEquals(null, $user[AUTHENTICATED]);
        $this->assertEquals(null, $user[USERNAME]);
        $this->assertEquals(false, $user->authenticated());
        $this->assertEquals(null, $user->username());
    }
}
