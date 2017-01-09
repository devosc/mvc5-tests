<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Builder;

use Mvc5\Model;

class Autowire
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var
     */
    protected $foo;

    /**
     * @param Model $model
     * @param $foo
     * @param null $bar
     * @param array $args
     */
    function __construct(Model $model, $foo, $bar = null, array $args = [])
    {
        $this->model = $model;
        $this->foo   = $foo;
    }
}
