<?php

namespace Mvc5\Test\Route\Definition\Build;

use Mvc5\Test\Test\TestCase;

class RegexTest
    extends TestCase
{
    /**
     *
     */
    public function test_regex()
    {
        $mock = $this->getCleanMock(Regex::class, ['regex', 'testRegex']);

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

        $this->assertEquals($regex, $mock->testRegex($tokens, $constraints));
    }

    /**
     *
     */
    public function test_regex_with_delimiter()
    {
        $mock = $this->getCleanMock(Regex::class, ['regex', 'testRegex']);

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

        $this->assertEquals($regex, $mock->testRegex($tokens, $constraints));
    }

    /**
     *
     */
    public function test_regex_group_param()
    {
        $mock = $this->getCleanMock(Regex::class, ['regex', 'testRegex']);

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

        $this->assertEquals($regex, $mock->testRegex($tokens, $constraints));
    }
}
