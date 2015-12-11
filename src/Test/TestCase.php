<?php

namespace Mvc5\Test\Test;

use PHPUnit_Framework_TestCase as BaseTestCase;

class TestCase
    extends BaseTestCase
{
    /**
     * @param string $name
     * @param array $exclude
     * @param array $args
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getCleanAbstractMock($name, array $exclude = [], array $args = null)
    {
        return $this->mockBuilder($name, $exclude, $args)->getMockForAbstractClass();
    }

    /**
     * @param string $name
     * @param array $exclude
     * @param array $args
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getCleanMock($name, array $exclude = [], array $args = null)
    {
        return $this->mockBuilder($name, $exclude, $args)->getMock();
    }

    /**
     * @param $name
     * @param array $exclude
     * @param array $args
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getCleanMockForTrait($name, array $exclude = [], array $args = null)
    {
        return $this->getMockForTrait($name, (null === $args ? [] : $args), '', is_array($args), true, true, $this->methods($name, $exclude));
    }

    /**
     * @param $name
     * @param array $exclude
     * @return array
     */
    protected function methods($name, array $exclude = [])
    {
        $class = new \ReflectionClass($name);

        $methods = [];

        foreach($class->getMethods() as $method) {
            if (!in_array($method->getName(), $exclude)) {
                $methods[] = $method->getName();
            }
        }

        return $methods;
    }

    /**
     * @param $name
     * @param array $exclude
     * @param array $args
     * @return \PHPUnit_Framework_MockObject_MockBuilder
     */
    protected function mockBuilder($name, array $exclude = [], array $args = null)
    {
        $methods = $this->methods($name, $exclude);

        $mock = $this->getMockBuilder($name);

        null === $args ? $mock->disableOriginalConstructor() : $mock->setConstructorArgs($args);

        $methods && $mock->setMethods($this->methods($name, $exclude));

        return $mock;
    }
}
