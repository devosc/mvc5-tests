<?php
/**
 *
 */

namespace Mvc5\Test\Service\Builder;

use Mvc5\Model;

final class Autowire
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var
     */
    public $foo;

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
