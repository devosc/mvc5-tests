<?php

namespace Mvc5\Test\Route\Definition;

use Mvc5\Test\Test\TestCase;

class RegexTest
    extends TestCase
{
    /**
     *
     */
    public function test_regex()
    {
        /** @var Regex $mock */

        $mock = $this->getCleanAbstractMock(Regex::class, ['regex', 'regexTest']);

        $constraints = [
            //'author'   => '[a-zA-Z0-9_-]*',
            'category' => '[a-zA-Z0-9_-]*'
        ];

        $tokens = [
            ['literal', '/'],
            ['optional-start'],
            ['parameter', 'author', NULL],
            ['optional-start'],
            ['literal', '/'],
            ['parameter', 'category', NULL],
            ['optional-end'],
            ['optional-end']
        ];

        $regex = "/(?:(?P<param1>[^/]+)(?:/(?P<param2>[a-zA-Z0-9_-]*))?)?";

        $this->assertEquals($regex, $mock->regexTest($tokens, $constraints));
    }

    /**
     *
     */
    public function test_regex_with_delimiter()
    {
        /** @var Regex $mock */

        $mock = $this->getCleanAbstractMock(Regex::class, ['regex', 'regexTest']);

        $constraints = [
            //'author'   => '[a-zA-Z0-9_-]*',
            'category' => '[a-zA-Z0-9_-]*'
        ];

        $tokens = [
            ['literal', '/'],
            ['optional-start'],
            ['parameter', 'author', 'abc'],
            ['optional-start'],
            ['literal', '/'],
            ['parameter', 'category', NULL],
            ['optional-end'],
            ['optional-end']
        ];

        $regex = "/(?:(?P<param1>[^abc]+)(?:/(?P<param2>[a-zA-Z0-9_-]*))?)?";

        $this->assertEquals($regex, $mock->regexTest($tokens, $constraints));
    }

    /**
     *
     */
    public function test_regex_group_param()
    {
        /** @var Regex $mock */

        $mock = $this->getCleanAbstractMock(Regex::class, ['regex', 'regexTest']);

        $constraints = [
            //'author'   => '[a-zA-Z0-9_-]*',
            'category' => '[a-zA-Z0-9_-]*'
        ];

        $tokens = [
            ['literal', '/'],
            ['optional-start'],
            ['parameter', 'author', 'abc'],
            ['optional-start'],
            ['literal', '/'],
            ['parameter', 'category', NULL],
            ['optional-end'],
            ['optional-end']
        ];

        $regex = "/(?:(?P<param1>[^abc]+)(?:/(?P<param2>[a-zA-Z0-9_-]*))?)?";

        $this->assertEquals($regex, $mock->regexTest($tokens, $constraints));
    }
}
