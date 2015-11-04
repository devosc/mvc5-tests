<?php

namespace Mvc5\Test\Test;

use PHPUnit_Framework_TestCase as BaseTestCase;

class TestCase
    extends BaseTestCase
{
    /**
     * Creates a clean mock object that allows specified methods to execute
     *
     * @param string $name
     * @param array $exclude
     * @param array $args
     * @return mixed
     */
    public function getCleanAbstractMock($name, array $exclude = [], array $args = null)
    {
        $class = new \ReflectionClass($name);
;
        $methods = [];

        foreach($class->getMethods() as $method) {
            if (!in_array($method->getName(), $exclude)) {
                $methods[] = $method->getName();
            }
        }

        $mock = $this->getMockBuilder($name);

        null === $args ? $mock->disableOriginalConstructor() : $mock->setConstructorArgs($args);

        $methods && $mock->setMethods($methods);

        return $mock->getMockForAbstractClass();
    }

    /**
     * Creates a clean mock object that allows specified methods to execute
     *
     * @param string $name
     * @param array $exclude
     * @param array $args
     * @return mixed
     */
    public function getCleanMock($name, array $exclude = [], array $args = null)
    {
        $class = new \ReflectionClass($name);

        $methods = [];

        foreach($class->getMethods() as $method) {
            if (!in_array($method->getName(), $exclude)) {
                $methods[] = $method->getName();
            }
        }

        $mock = $this->getMockBuilder($name);

        null === $args ? $mock->disableOriginalConstructor() : $mock->setConstructorArgs($args);

        $methods && $mock->setMethods($methods);

        return $mock->getMock();
    }

    /**
     * @param $name
     * @param array $exclude
     * @param array $args
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getCleanMockForTrait($name, array $exclude = [], array $args = null)
    {
        $class = new \ReflectionClass($name);

        $methods = [];

        foreach($class->getMethods() as $method) {
            if (!in_array($method->getName(), $exclude)) {
                $methods[] = $method->getName();
            }
        }

        return $this->getMockForTrait($name, (null === $args ? [] : $args), '', is_array($args), true, true, $methods);
    }
}
