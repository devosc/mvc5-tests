<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Request\HttpRequest;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Merge;
use Mvc5\Test\Test\TestCase;

class MergeTest
    extends TestCase
{
    /**
     * @return \Closure
     */
    protected function next()
    {
        return function($route, $request) {
            return $route;
        };
    }

    /**
     *
     */
    function test_merge_csrf_token_is_null()
    {
        $method  = new Merge;
        $request = new HttpRequest;
        $route   = new Route(['parent' => new Route]);

        /** @var Route $new */
        $child = $method($route, $request, $this->next());

        $this->assertNull($child['csrf_token']);
    }

    /**
     *
     */
    function test_merge_csrf_token_from_parent()
    {
        $method  = new Merge;
        $request = new HttpRequest;
        $route   = new Route(['parent' => new Route(['csrf_token' => true])]);

        /** @var Route $new */
        $child = $method($route, $request, $this->next());

        $this->assertTrue($child['csrf_token']);
    }

    /**
     *
     */
    function test_merge_csrf_token_override_parent_value()
    {
        $method  = new Merge;
        $request = new HttpRequest;
        $parent  = new Route(['csrf_token' => true]);
        $route   = new Route(['csrf_token' => false, 'parent' => $parent]);

        /** @var Route $new */
        $child = $method($route, $request, $this->next());

        $this->assertTrue($parent['csrf_token']);
        $this->assertFalse($child['csrf_token']);
    }

    /**
     *
     */
    function test_merge_middleware()
    {
        $method  = new Merge;
        $request = new HttpRequest;
        $route   = new Route(['parent' => new Route(['middleware' => ['a']]),'middleware' => ['b']]);

        $new = $method($route, $request, $this->next());

        $this->assertNotEquals($route, $new);
        $this->assertEquals(['a', 'b'], $new[Arg::MIDDLEWARE]);
    }

    /**
     *
     */
    function test_merge_options()
    {
        $method  = new Merge;
        $request = new HttpRequest;
        $route   = new Route(['parent' => new Route(['options' => ['prefix' => 'Foo\\']])]);

        /** @var Route $new */
        $new = $method($route, $request, $this->next());

        $this->assertNotEquals($route, $new);
        $this->assertEquals(['prefix' => 'Foo\\'], $new->options());
    }

    /**
     *
     */
    function test_no_parent()
    {
        $method  = new Merge;
        $request = new HttpRequest;
        $route   = new Route;

        $this->assertEquals($route, $method($route, $request, $this->next()));
    }
}
