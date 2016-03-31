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
     * @return callable|mixed|null|string|object
     */
    function content()
    {
        return 'foo';
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
        return $this;
    }

    /**
     * @param int $code
     * @param string $text
     * @return self
     */
    function setStatus($code, $text = '')
    {
        return $this;
    }

    /**
     * @return int
     */
    function status()
    {
        return 'foo';
    }
}
