<?php
/**
 *
 */

namespace Mvc5\Test\Controller;

use Mvc5\Controller\Dispatch as Base;
use Throwable;

abstract class Dispatch
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
     * @param array|callable|object|string $config
     * @return callable
     */
    public function controllerTest($config)
    {
        return $this->controller($config);
    }

    /**
     * @param callable $controller
     * @param array $args
     * @return mixed
     */
    public function dispatchTest(callable $controller, array $args = [])
    {
        return $this->dispatch($controller, $args);
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
