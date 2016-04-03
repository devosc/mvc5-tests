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
    public function id()
    {
        return $this->id;
    }

    /**
     * @param $name
     * @param $id
     */
    public function init($name, $id)
    {
        $this->name = $name;
        $this->id   = $id;
    }

    /**
     * @param $foo
     * @param self $object
     * @return self
     */
    public function initialize($foo, self $object)
    {
        $object->name($foo);

        return $object;
    }

    /**
     * @param null $name
     * @return null
     */
    public function name($name = null)
    {
        return null !== $name ? $this->name = $name : $this->name;
    }

    /**
     * @param $foo
     * @param self $object
     * @return self
     */
    public function __invoke($foo, self $object)
    {
        $object->name($foo);

        return $object;
    }
}
