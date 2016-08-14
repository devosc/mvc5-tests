<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Model;

class Hydrate
{
    /**
     * @var
     */
    protected $id;

    /**
     * @var
     */
    protected $name;

    /**
     * @return mixed
     */
    function id()
    {
        return $this->id;
    }

    /**
     * @param $name
     * @param $id
     */
    function init($name, $id)
    {
        $this->name = $name;
        $this->id   = $id;
    }

    /**
     * @param $foo
     * @param Hydrate $object
     * @return Hydrate
     */
    function initialize($foo, self $object)
    {
        $object->name($foo);

        return $object;
    }

    /**
     * @param null $name
     * @return null
     */
    function name($name = null)
    {
        return null !== $name ? $this->name = $name : $this->name;
    }

    /**
     * @param $foo
     * @param Hydrate $object
     * @return Hydrate
     */
    function __invoke($foo, self $object)
    {
        $object->name($foo);

        return $object;
    }
}
