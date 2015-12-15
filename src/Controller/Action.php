<?php
/**
 *
 */

namespace Mvc5\Test\Controller;

use Mvc5\Controller\Action as Base;
use Throwable;

abstract class Action
{
    /**
     *
     */
    use Base;

    /**
     * @param callable $controller
     * @param array $args
     * @return mixed
     */
    public function actionTest(callable $controller, array $args = [])
    {
        return $this->action($controller, $args);
    }

    /**
     * @param Throwable $exception
     * @param $controller
     * @return mixed
     */
    public function exceptionTest(Throwable $exception, $controller)
    {
        return $this->exception($exception, $controller);
    }
}
