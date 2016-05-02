<?php
/**
 *
 */

namespace Mvc5\Test\Route\Definition;

use Mvc5\Test\Test\TestCase;

class RegexTest
    extends TestCase
{
    /**
     *
     */
    function test_regex()
    {
        $regex = new Regex;

        $constraints = [
            //'author'   => '[a-zA-Z0-9_-]*',
            'category' => '[a-zA-Z0-9_-]*'
        ];

        $tokens = [
            ['literal', '/'],
            ['optional-start'],
            ['param', 'author', NULL],
            ['optional-start'],
            ['literal', '/'],
            ['param', 'category', NULL],
            ['optional-end'],
            ['optional-end']
        ];

        $pattern = "/(?:(?P<param1>[^/]+)(?:/(?P<param2>[a-zA-Z0-9_-]*))?)?";

        $this->assertEquals($pattern, $regex->regex($tokens, $constraints));
    }

    /**
     *
     */
    function test_regex_with_delimiter()
    {
        $regex = new Regex;

        $constraints = [
            //'author'   => '[a-zA-Z0-9_-]*',
            'category' => '[a-zA-Z0-9_-]*'
        ];

        $tokens = [
            ['literal', '/'],
            ['optional-start'],
            ['param', 'author', 'abc'],
            ['optional-start'],
            ['literal', '/'],
            ['param', 'category', NULL],
            ['optional-end'],
            ['optional-end']
        ];

        $pattern = "/(?:(?P<param1>[^abc]+)(?:/(?P<param2>[a-zA-Z0-9_-]*))?)?";

        $this->assertEquals($pattern, $regex->regex($tokens, $constraints));
    }

    /**
     *
     */
    function test_regex_group_arg()
    {
        $regex = new Regex;

        $constraints = [
            //'author'   => '[a-zA-Z0-9_-]*',
            'category' => '[a-zA-Z0-9_-]*'
        ];

        $tokens = [
            ['literal', '/'],
            ['optional-start'],
            ['param', 'author', 'abc'],
            ['optional-start'],
            ['literal', '/'],
            ['param', 'category', NULL],
            ['optional-end'],
            ['optional-end']
        ];

        $pattern = "/(?:(?P<param1>[^abc]+)(?:/(?P<param2>[a-zA-Z0-9_-]*))?)?";

        $this->assertEquals($pattern, $regex->regex($tokens, $constraints));
    }
}
