<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Model;

class Autowire
{
    /**
     * @var CallEvent
     */
    protected $event;

    /**
     * @var
     */
    protected $foo;

    /**
     * @param CallEvent $event
     * @param $foo
     * @param null $bar
     * @param array $args
     */
    function __construct(CallEvent $event, $foo, $bar = null, array $args = [])
    {
        $this->event = $event;
        $this->foo   = $foo;
    }
}
