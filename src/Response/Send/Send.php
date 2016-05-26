<?php
/**
 *
 */

namespace Mvc5\Test\Response\Send;

use Mvc5\Response\Send\Send as ResponseSend;

class Send
{
    /**
     *
     */
    use ResponseSend {
        body    as public;
        headers as public;
        send    as public;
    }
}
