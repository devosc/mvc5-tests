<?php
/**
 *
 */

namespace Mvc5\Test\Response;

use Mvc5\Response\Sender as Base;
use Mvc5\Response\Response;
use Throwable;

abstract class Sender
{
    use Base;

    /**
     * @param Throwable $exception
     * @param $response
     * @return Response
     */
    public function exceptionTest(Throwable $exception, $response)
    {
        return $this->exception($exception, $response);
    }

    /**
     * @param $response
     * @return mixed
     */
    public function sendTest($response)
    {
        return $this->send($response);
    }
}
