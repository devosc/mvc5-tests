<?php
/**
 *
 */

namespace Mvc5\Test\View;

use Mvc5\View\Renderer as Base;
use Throwable;

abstract class Renderer
{
    /**
     *
     */
    use Base;

    /**
     * @param Throwable $exception
     * @param $model
     * @return mixed
     */
    public function exceptionTest(Throwable $exception, $model)
    {
        return $this->exception($exception, $model);
    }

    /**
     * @param $model
     * @param array $args
     * @return mixed
     */
    public function renderTest($model, array $args = [])
    {
        return $this->render($model, $args);
    }
}
