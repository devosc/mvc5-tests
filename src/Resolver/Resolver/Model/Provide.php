<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Model;

class Provide
{
    /**
     * @var
     */
    public $a;

    /**
     * @var
     */
    public $b;

    /**
     * @var
     */
    public $c;

    /**
     * @param $a
     * @param $b
     * @param $c
     */
    function __construct($a, $b = null, $c = null)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }
}
