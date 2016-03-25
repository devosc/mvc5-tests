<?php
/**
 *
 */

namespace Mvc5\Test\Controller;

use Mvc5\Response\Error;
use Mvc5\Response\Response;
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
     * @param Error $error
     * @param Response $response
     * @return mixed
     */
    public function errorTest(Error $error, Response $response)
    {
        return $this->error($error, $response);
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
