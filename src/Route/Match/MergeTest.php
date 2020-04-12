<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Closure;
use Mvc5\Request\HttpRequest;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Merge;
use Mvc5\Test\Test\TestCase;

final class MergeTest
    extends TestCase
{
    /**
     * @return Closure
     */
    protected function next() : Closure
    {
        return fn($route, $request) => $route;
    }

    /**
     *
     */
    function test_merge_authenticate_is_null()
    {
        $method  = new Merge;
        $request = new HttpRequest;
        $route   = new Route(['parent' => new Route]);

        $child = $method($route, $request, $this->next());

        $this->assertNull($child['authenticate']);
    }

    /**
     *
     */
    function test_merge_authenticate_from_parent()
    {
        $method  = new Merge;
        $request = new HttpRequest;
        $route   = new Route(['parent' => new Route(['authenticate' => true])]);

        $child = $method($route, $request, $this->next());

        $this->assertTrue($child['authenticate']);
    }

    /**
     *
     */
    function test_merge_authenticate_override_parent_value()
    {
        $method  = new Merge;
        $request = new HttpRequest;
        $parent  = new Route(['authenticate' => true]);
        $route   = new Route(['authenticate' => false, 'parent' => $parent]);

        $child = $method($route, $request, $this->next());

        $this->assertTrue($parent['authenticate']);
        $this->assertFalse($child['authenticate']);
    }

    /**
     *
     */
    function test_merge_csrf_token_is_null()
    {
        $method  = new Merge;
        $request = new HttpRequest;
        $route   = new Route(['parent' => new Route]);

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
        $this->assertEquals(['a', 'b'], $new['middleware']);
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
