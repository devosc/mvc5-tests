<?php
/**
 *
 */

namespace Mvc5\Test\Response;

use Mvc5\Response\Response as Mvc5Response;

class Response
    implements Mvc5Response
{
    /**
     * @var
     */
    protected $content;

    /**
     * @var
     */
    protected $status;

    /**
     * @return callable|mixed|null|string|object
     */
    function content()
    {
        return $this->content;
    }

    /**
     * @return void
     */
    function send()
    {
    }

    /**
     * @param  mixed $content
     * @return self
     */
    function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @param int $code
     * @param string $text
     * @return self
     */
    function setStatus($code, $text = '')
    {
        $this->status = $code;

        return $this;
    }

    /**
     * @return int
     */
    function status()
    {
        return $this->status;
    }
}
