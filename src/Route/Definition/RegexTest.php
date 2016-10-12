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

        $tokens = [
            ['literal', '/'],
            ['optional-start'],
            ['param', 'author', '[^/]+'],
            ['optional-start'],
            ['literal', '/'],
            ['param', 'category', '[a-zA-Z0-9_-]*'],
            ['optional-end'],
            ['optional-end']
        ];

        $pattern = "/(?:(?P<author>[^/]+)(?:/(?P<category>[a-zA-Z0-9_-]*))?)?";

        $this->assertEquals($pattern, $regex->regex($tokens));
    }

    /**
     *
     */
    function test_regex_with_delimiter()
    {
        $regex = new Regex;

        $tokens = [
            ['literal', '/'],
            ['optional-start'],
            ['param', 'author', '[^abc]+'],
            ['optional-start'],
            ['literal', '/'],
            ['param', 'category', '[a-zA-Z0-9_-]*'],
            ['optional-end'],
            ['optional-end']
        ];

        $pattern = "/(?:(?P<author>[^abc]+)(?:/(?P<category>[a-zA-Z0-9_-]*))?)?";

        $this->assertEquals($pattern, $regex->regex($tokens));
    }

    /**
     *
     */
    function test_regex_group_arg()
    {
        $regex = new Regex;

        $tokens = [
            ['literal', '/'],
            ['optional-start'],
            ['param', 'author', '[^abc]+'],
            ['optional-start'],
            ['literal', '/'],
            ['param', 'category', '[a-zA-Z0-9_-]*'],
            ['optional-end'],
            ['optional-end']
        ];

        $pattern = "/(?:(?P<author>[^abc]+)(?:/(?P<category>[a-zA-Z0-9_-]*))?)?";

        $this->assertEquals($pattern, $regex->regex($tokens));
    }
}
